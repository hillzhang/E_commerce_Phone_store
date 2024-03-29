/*function loadXMLDoc(dname)
{
if (window.XMLHttpRequest)
  {
  xhttp=new XMLHttpRequest();
  }
else
  {
  xhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xhttp.open("GET",dname,false);
xhttp.send("");
return xhttp.responseXML;
}*/
function loadXMLDoc(dname)
{
var xmlDoc;
if (window.XMLHttpRequest)
  {
  xmlDoc=new window.XMLHttpRequest();
  xmlDoc.open("GET",dname,false);
  xmlDoc.send("");
  return xmlDoc.responseXML;
  }
// IE 5 and IE 6
else if (ActiveXObject("Microsoft.XMLDOM"))
  {
  xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
  xmlDoc.async=false;
  xmlDoc.load(dname);
  return xmlDoc;
  }
}
function displayResult(nameXSL)
{
xml=loadXMLDoc("phones.xml");
xsl=loadXMLDoc("phones.xsl");
// code for IE
if (window.ActiveXObject)
  {
  ex=xml.transformNode(xsl);
  document.getElementById("displayBook").innerHTML=ex;
  }
// code for Mozilla, Firefox, Opera, etc.
else if (document.implementation && document.implementation.createDocument)
  {
  xsltProcessor=new XSLTProcessor();
  xsltProcessor.importStylesheet(xsl);
  resultDocument = xsltProcessor.transformToFragment(xml,document);
  document.getElementById("displayBook").appendChild(resultDocument);
  }
}

function displayTitle(num)//get Title from XML
{
 
xmlDoc=loadXMLDoc("phones.xml");
  
a=xmlDoc.getElementsByTagName("TITLE")[num];
b=a.childNodes[0];
document.write(b.nodeValue);
}

function displayDesc(num)//get Description from XML
{
xmlDoc=loadXMLDoc("phones.xml");

a=xmlDoc.getElementsByTagName("DESCRIPTION")[num];
b=a.childNodes[0];
document.write(b.nodeValue);
}

function displayShortDesc(num)//get Short Description from XML
{
xmlDoc=loadXMLDoc("phones.xml");

a=xmlDoc.getElementsByTagName("SHORTDESCRIPTION")[num];
b=a.childNodes[0];
document.write(b.nodeValue);
}

function displayPrice(num)//get Price from XML
{
xmlDoc=loadXMLDoc("phones.xml");

a=xmlDoc.getElementsByTagName("PRICE")[num];
b=a.childNodes[0];
document.write(b.nodeValue);
}

function displayCompany(num)//get COMPANY from XML
{
xmlDoc=loadXMLDoc("phones.xml");

a=xmlDoc.getElementsByTagName("COMPANY")[num];
b=a.childNodes[0];
document.write(b.nodeValue);
}

function displayPublisher(num)//get Publisher from XML
{
xmlDoc=loadXMLDoc("phones.xml");

a=xmlDoc.getElementsByTagName("PUBLISHER")[num];
b=a.childNodes[0];
document.write(b.nodeValue);
}

function displayYear(num)//get Year from XML
{
xmlDoc=loadXMLDoc("phones.xml");

a=xmlDoc.getElementsByTagName("YEAR")[num];
b=a.childNodes[0];
document.write(b.nodeValue);
}

