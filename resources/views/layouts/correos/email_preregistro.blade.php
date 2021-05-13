<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Diseño de email</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<style type="text/css">
		a[x-apple-data-detectors] {color: inherit !important;}
	</style>

</head>
<body style="margin: 0; padding: 0;">
	<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td style="padding: 20px 0 30px 0;">

<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
	<tr>
		<td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0;">
			<img src="{{asset('images/h1.gif')}}" alt="Creating Email Magic." width="300" height="230" style="display: block;" />
		</td>
	</tr>
	<tr>
		<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
				<tr>
					<td style="color: #153643; font-family: Arial, sans-serif;">
						<h1 style="font-size: 24px; margin: 0;">Gracias {{ $visita_nombre }} por realizar tu preregistro!</h1>
					</td>
				</tr>
				<tr>
					<td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
						<p style="margin: 0;">Nos pondremos en contacto contigo al correo {{ $visita_correo }}, y ofrecerte mejor información de paquetes sobre el servicio , así como los beneficios de contratarnos.</p>
            <br>
            <p><h4>Mensaje Enviado: </h4><br>
                {{ $visita_mensaje }}
            </p>
						<br>
						<p>Datos de contacto:<br>
							{{ $visita_correo}}<br>
							{{ $visita_correo}}<br>
						</p>

					</td>
				</tr>
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
							<tr>
								<td width="260" valign="top">
									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
										<tr>
											<td>
												<img src="{{ asset('images/left.gif') }}" alt="" width="100%" height="140" style="display: block;" />
											</td>
										</tr>
										<tr>
											<td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
												<p style="margin: 0;"></p>
											</td>
										</tr>
									</table>
								</td>
								<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
								<td width="260" valign="top">
									<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
										<tr>
											<td>
												<img src="{{ asset('images/right.gif') }}" alt="" width="100%" height="140" style="display: block;" />
											</td>
										</tr>
										<tr>
											<td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
												<p style="margin: 0;"></p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td bgcolor="#ee4c50" style="padding: 30px 30px;">
    		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
				<tr>
					<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
						<p style="margin: 0;">&reg; Comunidad Digital<br/>
					 <a href="#" style="color: #ffffff;">Derechos Reservados</a></p>
           <p>5555555</p>
           <p>https://www.comunidad.com.mx</p>
					</td>
					<td align="right">
						<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
							<tr>
								<td>
									<a href="http://www.twitter.com/">
										<img src="{{ asset('images/tw.gif') }}" alt="Twitter." width="38" height="38" style="display: block;" border="0" />
									</a>
								</td>
								<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
								<td>
									<a href="http://www.twitter.com/">
										<img src="{{ asset('images/fb.gif') }}" alt="Facebook." width="38" height="38" style="display: block;" border="0" />
									</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
			</td>
		</tr>
	</table>
</body>
</html>
