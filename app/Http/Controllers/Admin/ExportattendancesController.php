<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;

class ExportattendancesController extends Controller
{
    public function downloadAttendancesPDF(Request $request)
    {
        $date = $request->input('date');

        if ($date) {
            $attendances = Attendance::whereDate('created_at', Carbon::createFromFormat('Y-m-d', $date))->get();
        } else {
            $attendances = Attendance::all();
        }

        $html = view('admin.employees.exportattendances', compact('attendances','date'));

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf = new Dompdf($options);

        $pdf->loadHtml($html);

        $pdf->setPaper('A4', 'landscape');

        $pdf->render();
        return $pdf->stream('attendance.pdf');
    }
}