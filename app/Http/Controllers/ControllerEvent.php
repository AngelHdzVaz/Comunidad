<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Event as Event;
class ControllerEvent extends Controller
{
    //
    public function verCrearEvento(){
      return view("crear_evento");
    }

    public function crear(Request $request){

        $this->validate($request, [
        'titulo'     =>  'required',
        'descripcion'  =>  'required',
        'fecha' =>  'required'
       ]);
         DB::beginTransaction();
        Event::create([
          'titulo'       => $request->input("titulo"),
          'descripcion'  => $request->input("descripcion"),
          'fecha'        => $request->input("fecha")
        ]);
          DB::commit();
        return back()->with('success', 'Enviado exitosamente!');

      }

    public function detallesEvento($id){
        $event = Event::find($id);
        return view("calendario_evento",["event" => $event
      ]);

      }

      public function actualizarEvento(Request $request){
        $id = $request->id;
        $titulo = $request->titulo;
        $descripcion = $request->descripcion;
        $fecha = $request->fecha;
        try{
          $this->validate($request, [
          $titulo     =>  'required',
          $descripcion  =>  'required',
          $fecha =>  'required'
         ]);

          DB::beginTransaction();

         Event::where('id',$event->id)->update([
           'titulo'       => $titulo,
           'descripcion'  => $descripcion,
           'fecha'        => $fecha
         ]);
           DB::commit();

           return redirect()->back()->with([
             'titulo' => 'Actualización exitosa',
             'mensaje' => '',
             'tipo' => 'success'
           ]);

       }catch (\Exception $e) {

         DB::rollback();

         return $e->getMessage();
       }
      }

    // =================== CALENDARIO =====================

    public function actual(){
       $month = date("Y-m");
       $data = $this->calendar_month($month);
       $mes = $data['month'];
       $mespanish = $this->spanish_month($mes);
       return view("calendario",[
         'data' => $data,
         'mes' => $mes,
         'mespanish' => $mespanish
       ]);

   }

    public function mesAnterior(Request $request){
        $month = $request->month;
        $data = $this->calendar_month($month);
        $mes = $data['month'];
        $mespanish = $this->spanish_month($mes);
        return view("calendario",[
          'data' => $data,
          'mes' => $mes,
          'mespanish' => $mespanish
        ]);
      }

      public function mesSiguiente(Request $request){
          $month = $request->month;
          $data = $this->calendar_month($month);
          $mes = $data['month'];
          $mespanish = $this->spanish_month($mes);
          return view("calendario",[
            'data' => $data,
            'mes' => $mes,
            'mespanish' => $mespanish
          ]);
        }

    public static function calendar_month($month){
        //$mes = date("Y-m");
        $mes = $month;
        //sacar el ultimo de dia del mes
        $daylast =  date("Y-m-d", strtotime("last day of ".$mes));
        //sacar el dia de dia del mes
        $fecha      =  date("Y-m-d", strtotime("first day of ".$mes));
        $daysmonth  =  date("d", strtotime($fecha));
        $montmonth  =  date("m", strtotime($fecha));
        $yearmonth  =  date("Y", strtotime($fecha));
        // sacar el lunes de la primera semana
        $nuevaFecha = mktime(0,0,0,$montmonth,$daysmonth,$yearmonth);
        $diaDeLaSemana = date("w", $nuevaFecha);
        $nuevaFecha = $nuevaFecha - ($diaDeLaSemana*24*3600); //Restar los segundos totales de los dias transcurridos de la semana
        $dateini = date ("Y-m-d",$nuevaFecha);
        //$dateini = date("Y-m-d",strtotime($dateini."+ 1 day"));
        // numero de primer semana del mes
        $semana1 = date("W",strtotime($fecha));
        // numero de ultima semana del mes
        $semana2 = date("W",strtotime($daylast));
        // semana todal del mes
        if (date("m", strtotime($mes))==1) {
            $semana = 6;
              // en caso si es diciembre
        }else if (date("m", strtotime($mes))==12) {
            $semana = 5;
        }else if (date("m", strtotime($mes))==8) {
            $semana = 4;
        }
        else {
          $semana = ($semana2-$semana1)+1;
        }
        // semana todal del mes
        $datafecha = $dateini;
        $calendario = array();
        $iweek = 0;
        while ($iweek < $semana):
            $iweek++;
            //echo "Semana $iweek <br>";

            $weekdata = [];
            for ($iday=0; $iday < 7 ; $iday++){
              // code...
              $datafecha = date("Y-m-d",strtotime($datafecha."+ 1 day"));
              $datanew['mes'] = date("M", strtotime($datafecha));
              $datanew['dia'] = date("d", strtotime($datafecha));
              $datanew['fecha'] = $datafecha;
              //AGREGAR CONSULTAS EVENTO
              $datanew['evento'] = Event::where("fecha",$datafecha)->get();

              array_push($weekdata,$datanew);
            }
            $dataweek['semana'] = $iweek-1;
            $dataweek['datos'] = $weekdata;
            array_push($calendario,$dataweek);
        endwhile;
        $nextmonth = date("Y-M",strtotime($mes."+ 1 month"));
        $lastmonth = date("Y-M",strtotime($mes."- 1 month"));
        $month = date("M",strtotime($mes));
        $yearmonth = date("Y",strtotime($mes));
        $data = array(
          'next' => $nextmonth,
          'month'=> $month,
          'year' => $yearmonth,
          'last' => $lastmonth,
          'calendar' => $calendario,
        );
        return $data;
      }

    public static function spanish_month($month){

        $mes = $month;
        if ($month=="Jan") {
          $mes = "Enero";
        }
        elseif ($month=="Feb")  {
          $mes = "Febrero";
        }
        elseif ($month=="Mar")  {
          $mes = "Marzo";
        }
        elseif ($month=="Apr") {
          $mes = "Abril";
        }
        elseif ($month=="May") {
          $mes = "Mayo";
        }
        elseif ($month=="Jun") {
          $mes = "Junio";
        }
        elseif ($month=="Jul") {
          $mes = "Julio";
        }
        elseif ($month=="Aug") {
          $mes = "Agosto";
        }
        elseif ($month=="Sep") {
          $mes = "Septiembre";
        }
        elseif ($month=="Oct") {
          $mes = "Octubre";
        }
        elseif ($month=="Oct") {
          $mes = "December";
        }
        elseif ($month=="Dec") {
          $mes = "Diciembre";
        }
        else {
          $mes = $month;
        }
        return $mes;
    }

}
