<div>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<div class="footer">
	<div class="left" align="left">
		<p>ASPCRE - Associação de Servidores da Prefeitura da Cidade do Recife</p>
	</div>
	<div class="rigth" align="right">
			<p><i class="fas fa-phone"></i> (81) 3421-1889 | (81) 3039-2034 | <i class="fab fa-whatsapp"></i> (81) 98639-3333 </p>
	</div>
</div>

<div class="footer-mobile">
	<p>ASPCRE - Associação de Servidores da Prefeitura da Cidade do Recife</p>
</div>

<style>
@media only screen and (max-width: 600px)
{
  .footer
  {
    display: none;
  }
  .footer-mobile{background-color: #43435d5c;}

}
@media only screen and (min-width: 600px) and (max-width: 1024px)
{
.footer-mobile
{
	display: none;
}
.left{left: 20%;}
.rigth{right: 26%!important;}
}
@media only screen and (min-width: 1024px)
{
	.footer-mobile
	{
		display: none;
	}
	.left{left: 5%;}
	.rigth{right: 5%!important;}
}

.footer
{
	position: fixed;
	left: 0;
	bottom: 0;
	width: 100%;
	background: #717070;
	color: white;
	text-align: center;
}
.footer-mobile
{
	position: fixed;
	left: 0;
	bottom: 0;
	width: 100%;
	background: #3f3c31bf;
	color: white;
	text-align: center;
}
.footer-mobile p
{
	font-size: 12px;
	margin: 0;
	padding-top: 3px;
}
.left
{
	padding-left: 1%;
	bottom: 0;
	float: left;
	padding-top: 0.5%;
}
.rigth
{
	position: relative;
	right: 17%;
	bottom: 0;
	float: right;
	padding-top: 0.5%;
}
</style>
