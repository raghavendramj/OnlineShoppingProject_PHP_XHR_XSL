var xhr = createRequest();

function addItemToGoodsList()
{
	if(!validateForCorrectData()){
		return;
	}

	var itemname = document.getElementById('itemname').value.trim();
	var itemprice = document.getElementById('itemprice').value.trim();
	var description = document.getElementById('description').value.trim();
	var itemquantity = document.getElementById('itemquantity').value.trim();
	
	
	var requestbody = "itemname=" + encodeURIComponent(itemname) + 
					  "&itemprice=" + encodeURIComponent(itemprice) +
					  "&description=" + encodeURIComponent(description) +
					  "&itemquantity=" + encodeURIComponent(itemquantity)+
					  "&action=showItems";
	
	if(xhr)
		createAsyncConection(xhr, "php/listing.php", "get", requestbody, document.getElementById("targetDiv"));
	
	clearFormEntries();
}
function clearFormEntries(){
	document.getElementById('itemname').value = "";
	document.getElementById('itemprice').value = "";
	document.getElementById('description').value = "";
	document.getElementById('itemquantity').value = "";
}

function validateForCorrectData(){
	var itemname = document.getElementById('itemname').value.trim();
	var itemprice = document.getElementById('itemprice').value.trim();
	var description = document.getElementById('description').value.trim();
	var itemquantity = document.getElementById('itemquantity').value.trim();
	
	if (itemname==null || itemname.trim()== "" 
		|| description==null || description.trim()== "" 
		|| itemprice==null || itemprice.trim()== "" 
		|| itemquantity==null || itemquantity.trim()== "")
	{
		alert("Please fill all details");
		return false;	
	}
	
	var price = parseInt(Number(itemprice));
	
	if (price < 0) {
		alert('Please provide a valid Price');
		document.listingForm.itemprice.focus();
		return false;	
	}
	
	return true;
}
