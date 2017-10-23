var xhr= createRequest();

//On DOMContentLoaded(Complete HTML Page load, this function will be executed).
document.addEventListener("DOMContentLoaded", function(event){
	loadOrRefreshBuyOnlinePage();
});

function loadOrRefreshBuyOnlinePage()
{
	killAllTheCurrentRequest(xhr);
	if (xhr){
		createAsyncConection(xhr, "php/login.php", "get", "action=laodShoppingCatalog", document.getElementById("shoppingCatalog"));
	}
}

function getProcessedDataResults()
{
	if (xhr){
		createAsyncConection(xhr, "php/login.php", "get", "action=loadProcessingPage", document.getElementById("results"));
	}
}

function manageCart(event, action)
{
	var itemnumber = event.currentTarget.parentElement.parentElement.firstElementChild.textContent;
	var	requestparams  =  "itemnumber=" + itemnumber + "&action="+ action;
	
	if (xhr)
		createAsyncConectionWithCallBack(xhr, "php/addItemToCart.php", "get", requestparams, onSucessLoadPage);
}

function onSucessLoadPage()
{
	if (xhr.readyState == 4 && xhr.status == 200) {
		console.log(xhr.responseText);
		alert(xhr.responseText)
		loadOrRefreshBuyOnlinePage();
	}
}

function processPurchase(event, action)
{
	var	selectedTRs = document.getElementsByClassName("shoppingCartRow");
	var selectedIds = new Array(); 
	var totalAmountDue = 0;
	for(var index in selectedTRs) { 
		if (selectedTRs.hasOwnProperty(index)) {
			var currentElement = selectedTRs[index];
			var itemNumber = currentElement.children[0].textContent;
			var itemPrice = currentElement.children[2].textContent;
			itemPrice =  itemPrice.replace("$", "");
			itemPrice =  itemPrice.trim();
			var itemCount = currentElement.children[3].textContent.trim();
			selectedIds.push(itemNumber+"-"+itemCount);
			totalAmountDue = totalAmountDue + (parseInt(itemPrice) * parseInt(itemCount));
		}
	}
	
	var response = confirm("Your purchase has been confirmed and total amount due to pay is "+totalAmountDue);
	if (response == false) 
	{
		alert("Your purchase request has been cancelled, welcome to shop next time")
		return;
	}
		

	var	requestparams  =  "itemIds=" + selectedIds.join(",") + "&action="+ action;

	if (xhr)
		createAsyncConectionWithCallBack(xhr, "php/purchase.php", "get", requestparams, processPurchaseCallBack(document.getElementById("errorDataXHR")));
}

function processPurchaseCallBack(elementToAppendOnCallBack)
{
	if (xhr.readyState == 4 && xhr.status == 200) 
	{
		alert("Thanks for shopping with us!");
		setTimeout(function(){ window.location="buyonline.htm"; }, 2000);
	}
}