var xhr= createRequest();

function getProcessedDataResults(){
	console.log("Get Results!");
    xhr.open("GET", "php/processing.php?id=" + Number(new Date), true);
    xhr.onreadystatechange = getData;
    xhr.send(null);     
}
	
function getData()
{
    console.log("Get Data!");
    if ((xhr.readyState == 4) &&(xhr.status == 200))
    {
	// write code here to write the html that comes from the server into the span with id “results” in the html document
     var replyStr = xhr.responseText;
     var spanTag = document.getElementById("results");
     spanTag.innerHTML = replyStr;
    }
}