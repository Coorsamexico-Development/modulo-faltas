<?php
namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ArchivoController extends Controller
{
    public function generar(Request $request)
    {
        $request->validate([
            'RP' => ['required'],
            'mes' => ['required'],
            'file' => ['required', 'file', 'mimes:xlsx,xls']
        ]);

        $rp = strtoupper(trim($request->input('RP')));
        $mes = $request->input('mes');
        $spreadsheet = IOFactory::load($request->file('file')->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $filas = $sheet->toArray();
        $contenido = "";

        foreach ($filas as $index => $fila) {
            if ($index === 0) continue;
            $nss = trim($fila[0]);
            $faltas = [];

            for ($i = 1; $i < count($fila); $i++) {
                if (str_starts_with(strtoupper(trim($fila[$i])), 'F')) {
                    $dia = str_pad($i, 2, '0', STR_PAD_LEFT);
                    $fecha = DateTime::createFromFormat('Y-m-d', "$mes-$dia");
                    if ($fecha) {
                        $faltas[] = $fecha->format('dmY');
                    }
                }
            }

            if (empty($faltas)) continue;
            usort($faltas, function ($a, $b) {
                $d1 = DateTime::createFromFormat('dmY', $a);
                $d2 = DateTime::createFromFormat('dmY', $b);
                return $d1 <=> $d2;
            });
            $inicioRacha = null;
            $conteo = 1;

            for ($i = 0; $i < count($faltas); $i++) {
                $fechaActual = DateTime::createFromFormat('dmY', $faltas[$i]);
                if ($i === 0) {
                    $inicioRacha = $fechaActual;
                    continue;
                }
                $fechaAnterior = DateTime::createFromFormat('dmY', $faltas[$i - 1]);
                $diferencia = $fechaAnterior->diff($fechaActual)->days; 
                if ($diferencia === 1) {
                    $conteo++;
                } else {
                    $contenido .= str_pad($rp, 0) . str_pad($nss, 0) . "11" . str_pad($inicioRacha->format('dmY'), 16) . str_pad("0" . $conteo . "0000000", 0) . "\r\n" . str_repeat(' ', 0);
                    $inicioRacha = $fechaActual;
                    $conteo = 1;
                }
            }

            if (!empty($inicioRacha)) {
                $contenido .= str_pad($rp, 0) . str_pad($nss, 0) . "11" . str_pad($inicioRacha->format('dmY'), 16) . str_pad("0" . $conteo . "0000000", 0) . "\r\n" . str_repeat(' ', 0);
            }
        }
        $nombreArchivo = 'FALTAS.TXT';
        $contenidoWindows1252 = iconv('UTF-8', 'Windows-1252//TRANSLIT', $contenido);
        Storage::disk('public')->put($nombreArchivo, $contenidoWindows1252);
        return response()->download(storage_path("app/public/$nombreArchivo"))->deleteFileAfterSend(true);

    }
}