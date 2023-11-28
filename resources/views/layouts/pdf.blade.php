<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Registro de Mejora</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<style>
			table {
				font-size: 12px;
			}
			#detalle{
				padding-right: 100px;
			}
		</style>
		
		<p ><img src="{{public_path('/img/unican.png')}}" style="padding: 10px; margin: 10px; black; float: left; width: 130px; height: 90px;">
        <img src="{{public_path('/img/facitec.png')}}" style="padding: 10px; margin: 10px;  black; float: right; width: 150px; height: 90px;"></p>
		<div align="center">
			<h1>{{ __("Facultad de Ciencias y Tecnología \n Universidad Nacional de Canindeyú") }}</h1>
		</div>
	
	</head>
<body>
	<script type="text/php">

	if ( isset($pdf) ) {

	  $font = Font_Metrics::get_font("verdana");;
	  $size = 6;
	  $color = array(0,0,0);
	  $text_height = Font_Metrics::get_font_height($font, $size);

	  $foot = $pdf->open_object();
	  
	  $w = $pdf->get_width();
	  $h = $pdf->get_height();

	  // Draw a line along the bottom
	  $y = $h - $text_height - 24;
	  $pdf->line(16, $y, $w - 16, $y, $color, 0.5);

	  $pdf->close_object();
	  $pdf->add_object($foot, "all");

	  $text = "Page {PAGE_NUM} of {PAGE_COUNT}";  

	  // Center the text
	  $width = Font_Metrics::get_text_width("Page 1 of 2", $font, $size);
	  $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
	  
	}
	</script>
	<div id="verde"></div>
	{{-- <div id="header">
		<table>
			<tr>
				<td>{{ Auth::user()->name }}</td>
				<td style="text-align: center;font-size: 30px;color: #000;">Sistema de Seguimiento</td>
				@if ($datos!="")
				<td style="text-align: right;">{{ $datos }}</td>
				@else
				 @yield('fecha')
				@endif
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;color: #000;">Salto del Guirá - Paraguay</td>
			</tr>
		</table>
	</div> --}}

	<div id="footer">
		
	</div>
	{{-- <div id="gris" >
		<div class="page-number"></div>
		<div class="infor">
			<p>Dirección: Bastión Popular Bloque 2 Solar 4 Manzana 779
			 <br> Email: amyshoes-2016@gmail.com
			  <br>Teléfono: 2115261 - 0983610154</p>
		</div>
	</div> --}}
	<section class="contenido">
		@yield('contenido')
	</section>
	
</body>


</html>