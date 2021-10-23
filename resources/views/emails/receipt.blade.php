<HTML><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>
		CheapTranscription Order Receipt
		</title>
		<style type="text/css">
			td, th { font-family:verdana, Arial, sans-serif; font-size:14px;}
			#emailTable { border-collapse:collapse; height:100% !important; margin:0; padding:0; width:100% !important; }
			#emailCell { border-top-width:0; height:100% !important; margin:0; padding:20px 10px; width:100% !important; text-align: center; }
			#noReplyText { color:#808080; text-align: center;}
			#headerBorder { border: 7px solid #C41230; }
			#schoolImageContainer { text-align: left; }
			#schoolNameContainer { text-align: right; }
			#emailTitle { font-weight: normal !important; font-size: 24px; text-align:center; }
			.secondaryTitle { font-weight: normal !important; font-size: 20px; text-align:center; }
			.emailSeparator { border: 1px solid #c0c0c0; }
			.tableSeparator { border: 1px solid #EEEEEE; }
			.tableContainer { width: 90%; }
			.buttonContainer { text-align: center; }
			.buttonLink { color: #ffffff; background-color: #C41230; text-decoration: none; padding: 10px 20px; border-radius: 4px; font-family: verdana,Arial,sans-serif; }
			.buttonText { margin: 10px 20px; }
			.help-text { color: #777; font-size: 12px; text-align: center;}
			.text-center { text-align: center; }
			.table-border-collapse { border-collapse:collapse; width:100%; }
			.width-100 { width: 100%; }
			.smallTable { border-collapse:collapse; }
			.smallTable	th, .smallTable td { font-size: 12px !important; }
			#selfServiceTitle { font-weight: normal !important; font-size: 20px; text-align:center; }
			#emailfooterContainer { background-color: #363839; }
			.footerLink, .footerLink a { color: #d1d2d4; text-align: center; }
			.footerText { color: #d1d2d4 !important; text-align: center; }
		</style>
	</head>
	<body>
		<table id="emailTable" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
			<tr>
				<td id="emailCell" align="center" valign="top">
					<table class="table-border-collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>&nbsp;</td>
							<td width="700">
								<table class="table-border-collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td valign="top">
											<table class="table-border-collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td id="noReplyText" align="center" valign="top">
														<strong><i><font color="#808080">Please do not reply to this email. Any replies will be deleted.</font></i></strong>
													</td>
												</tr>
												<tr>
													<td>
														<table class="table-border-collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
															<tr>
																<td class="emailSeparator" border="1" bordercolor="#c0c0c0" style="border: 1px solid #c0c0c0;"></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td valign="top">
											<table class="table-border-collapse"  border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td valign="top">
														<table class="table-border-collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
															<tr>
																<td id="schoolImageContainer" align="left">
																	<img src="https://www.cheaptranscription.io/img/logo_small.png" alt="School Logo" />
																</td>
																<td id="schoolNameContainer" align="right">
																	CheapTranscription.io<br />
																	Brooklyn, New York
																</td>
															</tr>
														</table>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table class="table-border-collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td id="headerBorder" border="7" bordercolor="#C41230" style="border: 7px solid #C41230;"></td>
												</tr>
											</table>
										</td>
									</tr>
                            											<tr>
										<td align="center" id="mainBody" valign="top">
											<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" width="100%">
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td>
														<h1 id="emailTitle" align="center">Transcription Order Receipt </h1>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												
																								<tr><td>&nbsp;</td></tr>
												<tr>
													<td>
														<table border="0" cellpadding="0" cellspacing="0" width="100%">
															<tr>
																<td class="emailSeparator" border="1" bordercolor="#c0c0c0"></td>
															</tr>
														</table>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td>
														<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" width="100%">
															<tr>
																<td colspan="3">
																	<h2 class="secondaryTitle" align="center">Transcription Order Information</h2>
																</td>
															</tr>
															<tr><td colspan="3">&nbsp;</td></tr>
															<tr>
																<td>&nbsp;</td>
																<td class="tableContainer" width="90%">
																	<table class="smallTable" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" width="100%">
																		<tr>
																			<td width="40%" valign="top" align="right"><b>Order Date:&nbsp;</b></td>
																			<td width="60%">{{$job->created_at}}</td>
																		</tr>
																		<tr>
																			<td valign="top" align="right"><b>Order Number:&nbsp;</b></td>
																			<td>{{$job->transactionid}}</td>
																		</tr>
																		<tr>
																			<td valign="top" align="right"><b>Customer:&nbsp;</b></td>
																			<td>{{$job->firstname}} {{$job->lastname}} @ {{$job->email}} </td>
																		</tr>
																		
																		
																			
																		
																		
																		
																			<tr>
																				<td valign="top" align="right"><b>Total Charge:&nbsp;</b></td>
																				<td>    {{$job->total_amount}}</td>
																			</tr>
																			
																		
																		
																		
																	</table>
																</td>
																<td>&nbsp;</td>
															</tr>
														</table>
													</td>
												</tr>

												
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td>
														<table border="0" cellpadding="0" cellspacing="0" width="100%">
															<tr>
																<td class="emailSeparator" border="1" bordercolor="#c0c0c0"></td>
															</tr>
														</table>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td>
														<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" width="100%">
															<tr>
																<td colspan="3">
																	<h2 class="secondaryTitle" align="center">Your Recipients</h2>
																</td>
															</tr>
															<tr><td colspan="3">&nbsp;</td></tr>
															
														</table>
													</td>
												</tr>
												
												
                            					
																									<tr><td>&nbsp;</td></tr>
												<tr>
													<td>
														<table border="0" cellpadding="0" cellspacing="0" width="100%">
															<tr>
																<td class="emailSeparator" border="1" bordercolor="#c0c0c0" style="border: 1px solid #c0c0c0;"></td>
															</tr>
														</table>
													</td>
												</tr>
												
												<tr>
													<td class="buttonContainer" align="center">
														<!--[if mso]>
															<v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://www.credentials-inc.com/CGI-BIN/rechkcgi.pgm?STATUS9C5768752j3Y6rxinCevIDz5tz9/vWA1ntsU=TP" style="height:28pt;v-text-anchor:middle;width:135pt;" arcsize="5%" strokecolor="#C41230" fillcolor="#C41230">
																<w:anchorlock/>
																<center style="color:#fff;font-family: verdana,Arial,sans-serif;font-size:16px;">View Order Status</center>
															</v:roundrect>
														<![endif]-->
														<a href="https://cheaptranscription.io/transcribestatus/{{$job->transactionid}}" target="_blank" style="background-color:#C41230;border:1px solid #C41230;border-radius:3px;color:#fff;display:inline-block;font-family: verdana,Arial,sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:175px;-webkit-text-size-adjust:none;mso-hide:all;">View Order</a>
													</td>
												</tr>
												
											</table>
										</td>
									</tr>
									<tr>
										<td valign="top">
											<table class="table-border-collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr><td>&nbsp;<br/>&nbsp;</td></tr>
												<tr>
													<td id="emailfooterContainer" bgcolor="#363839" valign="top">
														<table class="table-border-collapse width-100" border="0" cellpadding="0" cellspacing="0" width="100%">
															<tr>
																<td colspan="2">&nbsp;</td>
															</tr>
															<tr>
																<td class="footerLink" align="center"><font color="#d1d2d4"><a href="https://www.cheaptranscription.io/privacy" style="color: #d1d2d4;">Privacy Policy</a></font></td>
																<td class="footerLink" align="center"><font color="#d1d2d4"><a href="https://www.cheaptranscription.io/terms" style="color: #d1d2d4;">Terms of Use</a></font></td>
															</tr>
															<tr>
																<td colspan="2">&nbsp;</td>
															</tr>
															<tr>
																<td class="footerText" align="center" colspan="2" style="color: #d1d2d4">&copy; 2019 Cabal Partners, LLC All rights reserved </td>
															</tr>
															<tr><td colspan="2">&nbsp;</td></tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
