function executeTheseFunctions(){
    getTotalSales();
    getTotalRevenue();
    getTotalSalaryWage();
    getEmployeeOfTheMonth();
    getMostSoldProduct();
    getTop3Customers();
    getTotalNumOfCustomers();
}
executeTheseFunctions();
setInterval(executeTheseFunctions,10000);

function getTotalSales() {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const resp = JSON.parse(this.responseText);
		document.getElementById("totalSales").innerHTML = resp;
	}
	xhttp.open("POST", "../Controller/DashboardDataProcess/getTotalSales.php", false);
	xhttp.send();
}
function getTotalRevenue() {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const resp = JSON.parse(this.responseText);
		
		document.getElementById("totalRevenue").innerHTML = resp;
	}
	xhttp.open("POST", "../Controller/DashboardDataProcess/getTotalRevenue.php", false);
	xhttp.send();
}
function getTotalSalaryWage() {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const resp = JSON.parse(this.responseText);
		
		document.getElementById("totalEmpWage").innerHTML = resp;
	}
	xhttp.open("POST", "../Controller/DashboardDataProcess/getTotalSalaryWage.php", false);
	xhttp.send();
}
function getEmployeeOfTheMonth() {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const resp = JSON.parse(this.responseText);
		
		document.getElementById("empOfMonthUsername").innerHTML = "Username: "+resp[0];
		document.getElementById("empOfMonthFullName").innerHTML = "Fullname: "+resp[1];
		document.getElementById("empOfMonthScore").innerHTML = "Score: "+resp[2];
	}
	xhttp.open("POST", "../Controller/DashboardDataProcess/getEmployeeOfTheMonth.php", false);
	xhttp.send();
}
function getMostSoldProduct() {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const resp = JSON.parse(this.responseText);
		
		document.getElementById("mostSoldProductId").innerHTML = "ID: "+resp[0];
		document.getElementById("mostSoldProductName").innerHTML = "Name: "+resp[1];
		document.getElementById("mostSoldProductNumOfSales").innerHTML = "Number of Sales: "+resp[2];
	}
	xhttp.open("POST", "../Controller/DashboardDataProcess/getMostSoldProduct.php", false);
	xhttp.send();
}
function getTop3Customers() {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const resp = JSON.parse(this.responseText);
		
		document.getElementById("topCus1Id").innerHTML = "ID: "+resp["id"][0];
		document.getElementById("topCus1Name").innerHTML = "Name: "+resp["name"][0];
		document.getElementById("topCus1Email").innerHTML = "Email: "+resp["email"][0];
		
        document.getElementById("topCus2Id").innerHTML = "ID: "+resp["id"][1];
		document.getElementById("topCus2Name").innerHTML = "Name: "+resp["name"][1];
		document.getElementById("topCus2Email").innerHTML = "Email: "+resp["email"][1];
        
        document.getElementById("topCus3Id").innerHTML = "ID: "+resp["id"][2];
		document.getElementById("topCus3Name").innerHTML = "Name: "+resp["name"][2];
		document.getElementById("topCus3Email").innerHTML = "Email: "+resp["email"][2];
	}
	xhttp.open("POST", "../Controller/DashboardDataProcess/getTop3Customers.php", false);
	xhttp.send();
}
function getTotalNumOfCustomers() {
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function() {
		const resp = JSON.parse(this.responseText);
		document.getElementById("numOfCus").innerHTML = "Total Number of Customers: "+resp;
	}
	xhttp.open("GET", "../Controller/DashboardDataProcess/getTotalNumOfCustomers.php", true);
	xhttp.send();
}