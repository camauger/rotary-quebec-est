var pdfbuttontitle = 'Save web page to PDF free with www.web2pdfconvert.com';
if (typeof (pdfbuttonlabel) == 'undefined') {
    pdfbuttonlabel = 'Save page as PDF';
}
if (typeof (pdfbuttonstyle) == 'undefined') {
    pdfbuttonstyle = 'button'
}


document.write('<style type="text/css">.save_as_pdf {display:inline-block; width:128px;	height:26px;	background: url(http://www.web2pdfconvert.com/images/save-as-pdf-blank.gif) no-repeat; border-style:none 0px;text-align:center;}');
document.write('.save_as_pdf a  {	display:inline-block; 	width:115px;	height:20px; line-height:1.4em;   padding-left:17px;    padding-top:6px;	color:#000000;	text-decoration:none;	font-size:11px;	font-weight:bold;	font-family:Arial, Helvetica, sans-serif;	}');
document.write('.save_as_pdf a:hover  {	text-decoration:none; color:#000000;	}');
document.write('.save_as_pdf a:link  {	text-decoration:none; color:#000000;	}');
document.write('</style>');

if (pdfbuttonstyle == 'link') {
    document.write('<a href="javascript:savePageAsPDF()" title="' + pdfbuttontitle + '">' + pdfbuttonlabel + '</a>');
}
else
    if (pdfbuttonstyle == 'custimg') {
    document.write('<a href="javascript:savePageAsPDF()" title="' + pdfbuttontitle + '"><img align="absmiddle" alt="' + pdfbuttontitle + '" border="0" src="' + custimg + '" /></a>');
}
else {
    document.write('<span class="save_as_pdf"><a href="javascript:savePageAsPDF()" title="' + pdfbuttontitle + '">' + pdfbuttonlabel + '</a></span>');
}





if (title == null) {
    var title = escape(document.title);
}


if (typeof (id) != 'undefined') 
{
	if (id != null) {
    	var userid = '&id=' + id;
	}
}



function savePageAsPDF() {

    var pURL = "http://www.web2pdfconvert.com/engine.aspx?cURL=" + escape(document.location.href+"?pdf=allow") + "&title=" + title+ userid + "&ref=web";
    window.open(pURL);
}