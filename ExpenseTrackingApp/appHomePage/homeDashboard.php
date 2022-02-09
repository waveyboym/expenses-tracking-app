<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="homestyle.css">
    <title>Expenses Tracking App</title>
</head>
<body>
    <div class="selectNewExpense">
        <div class="close-div">
            <ion-icon name="close-outline" onclick="closeSection()"></ion-icon>
        </div>
        <div class="add-expense">
            <div class="expense-tabs" onclick="addExpense('fast-food-outline')">
                <ion-icon name="fast-food-outline"></ion-icon>
                <h6>food</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('water-outline')">
                <ion-icon name="water-outline"></ion-icon>
                <h6>utilites</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('bag-outline')">
                <ion-icon name="bag-outline"></ion-icon>
                <h6>shopping</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('train-outline')">
                <ion-icon name="train-outline"></ion-icon>
                <h6>transportation</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('phone-portrait-outline')">
                <ion-icon name="phone-portrait-outline"></ion-icon>
                <h6>phone bills</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('game-controller-outline')">
                <ion-icon name="game-controller-outline"></ion-icon>
                <h6>entertainment</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('home-outline')">
                <ion-icon name="home-outline"></ion-icon>
                <h6>home bills</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('airplane-outline')">
                <ion-icon name="airplane-outline"></ion-icon>
                <h6>travel bills</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('medkit-outline')">
                <ion-icon name="medkit-outline"></ion-icon>
                <h6>medical aid</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('school-outline', 'education')">
                <ion-icon name="school-outline"></ion-icon>
                <h6>education</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('gift-outline', 'gifts')">
                <ion-icon name="gift-outline"></ion-icon>
                <h6>gifts</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('paw-outline', 'pet')">
                <ion-icon name="paw-outline"></ion-icon>
                <h6>pet</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('barbell-outline', 'gym')">
                <ion-icon name="barbell-outline"></ion-icon>
                <h6>gym</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('cash-outline', 'tax')">
                <ion-icon name="cash-outline"></ion-icon>
                <h6>tax</h6>
            </div>
            <div class="expense-tabs" onclick="addExpense('add-circle-outline', 'other')">
                <ion-icon name="add-circle-outline"></ion-icon>
                <h6>other</h6>
            </div>
            
        </div>
    </div>

    <div class="priceSection">
        <div class="price-input-area">
            <input type="text" id="newPrice" name="price" placeholder="price in $">
            <br>
            <button type="submit" name="submit" onclick="submitPrice()">confirm expense</button>
        </div>
    </div>
    <div class="main-header">
        <h1>Expenses Tracking App</h1>
        <h2></h2>
        <div class="switchThemes">
            <ion-icon name="contrast-outline" onclick="switchThemes()"></ion-icon>
        </div>
        <a href="../loginsignupFiles/logoutFile.php" class="logout" color="white">
            <ion-icon name="log-out-outline"></ion-icon>
        </a>
        <div class="username">
            <ion-icon name="person-circle-outline"></ion-icon>
            <h1><?php echo $_SESSION["LoggedUserid"];?></h1>
        </div>
    </div>
    <div class="quickSummary">
        <div class="budgeted-amount">
            <h1>You have budgeted</h1>
            <h2>$0</h2>
        </div>
        <div class="spent-amount">
            <div class="first-half1">
                <h1>You have spent</h1>
                <h2>$0</h2>
            </div>
            <div class="second-half">
                <div class="rectangular-bar">
                    <div class="progress-bar1">
                        <h1>0%</h1> 
                    </div>
                </div>
            </div>
        </div>
        <div class="amount-left">
            <div class="first-half2">
                <h1>You have</h1>
                <h2>$0 left </h2>
            </div>
            <div class="second-half">
                <div class="rectangular-bar">
                    <div class="progress-bar2">
                        <h2>0%</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="main-content">
        <div class="expenses-area">
            <h1 onclick="expenses()">Expenses</h1>
            <h2 onclick="summary()">Summary</h2>

            <div class="tiles">
                <div class="add-new-expense" onclick="addNewExpense()">
                    <ion-icon name="add-outline"></ion-icon>
                </div>
            </div>
            </div>
        </div>

        <div class="more-options">
            <div class="change-budget">
                <div class="budget-img">

                </div>
                <div class="input-area">
                    <input type="text" id="newBudget" name="budget" placeholder="my new budget in $">
                    <br>
                    <button type="submit" name="submit" onclick="changeBudget()">Change Budget</button>
                </div>
            </div>
            <div class="graph">
                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
            </div>
        </div>
</nav>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
<script>
let yValues = [];
let xValues = [];
let backgroundColorForChart = "rgba(76, 0, 255, 0.25)";
let borderColorForChart = "rgba(76, 0, 255, 0.9)";
let globalThemeSwitcher = 0;
let globalUserBudget = <?php echo $_SESSION["UserBudget"]; ?>;
let globalMoneySpent = <?php echo $_SESSION["MoneySpent"]; ?>;
let globalMoneyLeft = <?php echo $_SESSION["MoneyLeft"]; ?>;
let globalMoneySpentPercentage = <?php echo $_SESSION["MoneySpentPercentage"]; ?>;
let globalMoneyLeftPercentage = <?php echo $_SESSION["MoneyLeftPercentage"]; ?>;
let globalNameOfExpense;//very important dont delete by mistake
<?php $ExpenseReportArray =  json_decode($_SESSION["ExpensesReport"]); ?>;

//onload values for counting interval functions !!!do not modify!!!
let counterForMoneySpentPercentage = 0;
let counterForMoneyLeftPercentage = 0;

//interval functions do not modify !!!
let globalcounterForMoneySpentPercentage = setInterval(displayMoneySpentPercentage, 50);
let globalcounterForMoneyLeftPercentage = setInterval(displayMoneyLeftPercentage, 50);

//read php array and initialise

let readPHParrayValues = function(){
    <?php
    //echo 'count($ExpenseReportArray)';
    for($i = 0; $i < count($ExpenseReportArray); ++$i){
        $NameOfExpenseIcon = $ExpenseReportArray[$i]->ExpenseIconName;
        $ExpensePrice = $ExpenseReportArray[$i]->Price;
        $DateAdded = $ExpenseReportArray[$i]->Date;
        ?>
        addDatatoPage('<?php echo $NameOfExpenseIcon?>', '<?php echo $ExpensePrice?>', '<?php echo $DateAdded ?>');
        <?php
    }
    ?>
}

let addDatatoPage = function(expenseIcon, expensePrice, dateLogged){
    let getAddNewExpense = document.querySelector(".add-new-expense");
    let newExpenseToAdd = document.createElement("div");
    newExpenseToAdd.className = "tempholder";

    newExpenseToAdd.innerHTML = '<div class="expense">'
                            + getIconHTML(expenseIcon)
                            +'<h1>' + getHtagDescription(expenseIcon) + '<br>$' + expensePrice + '</h1>'
                            +'</div>';
    getAddNewExpense.insertAdjacentHTML("afterend", newExpenseToAdd.innerHTML);
    xValues.push(dateLogged);
    yValues.push(expensePrice);
}

function displayMoneySpentPercentage(){
    let getMoneySpentPercentage = document.querySelector(".progress-bar1");
    let getMoneySpentPercentageh1 = document.querySelector(".progress-bar1 h1");
    if(counterForMoneySpentPercentage <= globalMoneySpentPercentage){
        if(getMoneySpentPercentage == null){
            return;
        }
        getMoneySpentPercentage.style.width = counterForMoneySpentPercentage + "%";
        getMoneySpentPercentageh1.innerHTML = counterForMoneySpentPercentage + "%";
        ++counterForMoneySpentPercentage;
    }
    else if(counterForMoneySpentPercentage >= globalMoneySpentPercentage){
        if(globalMoneySpentPercentage == 100){
            getMoneySpentPercentage.style.borderBottomRightRadius = "5px";
            getMoneySpentPercentage.style.borderTopRightRadius = "5px";
        }
        else if(globalMoneySpentPercentage < 100){
            getMoneySpentPercentage.style.borderBottomRightRadius = "0px";
            getMoneySpentPercentage.style.borderTopRightRadius = "0px";
        }
        stopdisplayMoneySpentPercentage();
    }
}

function displayMoneyLeftPercentage(){
    let getMoneyLeftPercentage = document.querySelector(".progress-bar2");
    let getMoneyLeftPercentageh1 = document.querySelector(".progress-bar2 h2");
    if(counterForMoneyLeftPercentage <= globalMoneyLeftPercentage){
        if(getMoneyLeftPercentage == null){
            return;
        }
        getMoneyLeftPercentage.style.width = counterForMoneyLeftPercentage + "%";
        getMoneyLeftPercentageh1.innerHTML = counterForMoneyLeftPercentage + "%";
        ++counterForMoneyLeftPercentage;
    }
    else if(counterForMoneyLeftPercentage >= globalMoneyLeftPercentage){
        if(globalMoneyLeftPercentage == 100){
            getMoneyLeftPercentage.style.borderBottomRightRadius = "5px";
            getMoneyLeftPercentage.style.borderTopRightRadius = "5px";
        }
        else if(globalMoneyLeftPercentage < 100){
            getMoneyLeftPercentage.style.borderBottomRightRadius = "0px";
            getMoneyLeftPercentage.style.borderTopRightRadius = "0px";
        }
        stopdisplayMoneyLeftPercentage();
    }
}

function stopdisplayMoneySpentPercentage(){
    clearInterval(globalcounterForMoneySpentPercentage);
}

function stopdisplayMoneyLeftPercentage(){
    clearInterval(globalcounterForMoneyLeftPercentage);
}

window.onload = function(){
    changeDisplayAccordingToTime();
    readPHParrayValues();
    displayChart();
    document.querySelector(".budgeted-amount h2").innerHTML = "$" + globalUserBudget;
    document.querySelector(".first-half1 h2").innerHTML = "$" + globalMoneySpent;
    document.querySelector(".first-half2 h2").innerHTML = "$" + globalMoneyLeft + " left";
}

let switchThemes = function(){
    let getBody = document.querySelector("body");

    if(globalThemeSwitcher == 0){
        getBody.style.backgroundImage = 'url("backgroundSand.jpg")';
        backgroundColorForChart = "rgba(255, 38, 0, 0.25)";
        borderColorForChart = "rgba(255, 60, 0, 0.9)";
        document.documentElement.style.setProperty('--white', 'rgb(194, 194, 194)');
        document.documentElement.style.setProperty('--textColorAlt', 'rgb(252, 178, 178)');
        document.documentElement.style.setProperty('--progressBarColours', 'linear-gradient(to right top, rgba(238, 167, 34, 0.597) ,rgb(255, 93, 93))');
        document.documentElement.style.setProperty('--submitButton', 'rgba(255, 144, 41, 0.741)');
        ++globalThemeSwitcher;
    }
    else if(globalThemeSwitcher == 1){
        getBody.style.backgroundImage = 'url("backgroundPurple.jpg")';
        backgroundColorForChart = "rgba(76, 0, 255, 0.25)";
        borderColorForChart = "rgba(76, 0, 255, 0.9)";
        document.documentElement.style.setProperty('--white', 'white');
        document.documentElement.style.setProperty('--textColorAlt', 'rgb(148, 102, 255)');
        document.documentElement.style.setProperty('--progressBarColours', 'linear-gradient(to right top, rgba(95, 34, 238, 0.597) ,rgb(141, 93, 255))');
        document.documentElement.style.setProperty('--submitButton', 'rgb(76, 0, 255)');
        globalThemeSwitcher = 0;
    }
    displayChart();
}

let displayChart = function(){
    const chart = new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                fill: true,
                backgroundColor: backgroundColorForChart,
                borderColor: borderColorForChart,
                data: yValues
            }]
        },
        options: {
            legend: {display: false},
            scales: {
                xAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    },
                    ticks: {min: 0}
                }]
            }
        }
    });
}

function changeDisplayAccordingToTime(){
    let getTime = new Date();
    let getMessage = document.querySelector(".main-header h2");

    if(getTime.getHours() >= 6 && getTime.getHours() < 17){
        getMessage.innerHTML = 'Good day ' + '<?php echo $_SESSION["LoggedUserid"];?>';
        globalThemeSwitcher = 1;
    }
    else if((getTime.getHours() >= 17 && getTime.getHours() <= 24) || (getTime.getHours() >= 0 &&  getTime.getHours() < 6)){
        getMessage.innerHTML = 'Good evening ' + '<?php echo $_SESSION["LoggedUserid"];?>';
        globalThemeSwitcher = 0;
    }
    switchThemes();
}



//main used functions
let summary = function(){
    let classToAddTo = document.querySelector(".expenses-area");
    let getAllExpenses = document.querySelectorAll(".expense");
    let getIcon = document.querySelectorAll(".expense ion-icon");
    let getText = document.querySelectorAll(".expense h1");
    document.querySelector(".tiles").remove();

    let overviewExpense = document.createElement("div");
    overviewExpense.className = "overview-expense";

    classToAddTo.appendChild(overviewExpense);



    let getoverviewExpenseClass = document.querySelector(".overview-expense");
    for(let i = 0; i < getAllExpenses.length; ++i){
        let tempText = getText[i].innerHTML;
        tempText = tempText.replace("<br>", " ");

        getoverviewExpenseClass.innerHTML = getoverviewExpenseClass.innerHTML 
                                +'<div class="expense-line-form">'
                                    +'<p>'+ (i + 1) +'</p>'
                                    + getIconHTML(getIcon[i].name)
                                    +'<h3>'+ tempText +'</h3>'
                                    +'<h4 onclick="deleteExpense('+ i +')">delete</h4>'
                                +'</div>';
    }
}

let expenses = function(){
    let classToAddTo = document.querySelector(".expenses-area");
    let getIcon = document.querySelectorAll(".expense-line-form ion-icon");
    let getExpenses = document.querySelectorAll(".expense-line-form");
    let getText = document.querySelectorAll(".expense-line-form h3");
    document.querySelector(".overview-expense").remove();

    let newTiles = document.createElement("div");
    newTiles.className = "tiles";

    classToAddTo.appendChild(newTiles);

    let getTilesClass = document.querySelector(".tiles");

    getTilesClass.innerHTML = getTilesClass.innerHTML 
                            + '<div class="add-new-expense" onclick="addNewExpense()">'
                                +'<ion-icon name="add-outline"></ion-icon>'
                            +'</div>';
    for(let i = 0; i < getExpenses.length; ++i){
        let tempText = getText[i].innerHTML;
        tempText = tempText.replace(" ", "<br>");

        getTilesClass.innerHTML = getTilesClass.innerHTML 
                                +'<div class="expense">'
                                    + getIconHTML(getIcon[i].name)
                                    +'<h1>'+ tempText +'</h1>'
                                +'</div>';
    }
}

let getIconHTML = function(iconName){
    if(iconName == "fast-food-outline"){
        //food
        return '<ion-icon name="fast-food-outline"></ion-icon>';
    }
    else if(iconName == "water-outline"){
        //utilities
        return '<ion-icon name="water-outline"></ion-icon>';
    }
    else if(iconName == "bag-outline"){
        //shopping
        return '<ion-icon name="bag-outline"></ion-icon>';
    }
    else if(iconName == "train-outline"){
        //transportation
        return '<ion-icon name="train-outline"></ion-icon>';
    }
    else if(iconName == "phone-portrait-outline"){
        //phone bills
        return '<ion-icon name="phone-portrait-outline"></ion-icon>';
    }
    else if(iconName == "game-controller-outline"){
        //entertainment
        return '<ion-icon name="game-controller-outline"></ion-icon>';
    }
    else if(iconName == "home-outline"){
        //housing bills
        return '<ion-icon name="home-outline"></ion-icon>';
    }
    else if(iconName == "airplane-outline"){
        //travel
        return '<ion-icon name="airplane-outline"></ion-icon>';
    }
    else if(iconName == "medkit-outline"){
        //medical aid
        return '<ion-icon name="medkit-outline"></ion-icon>';
    }
    else if(iconName == "school-outline"){
        //school fees
        return '<ion-icon name="school-outline"></ion-icon>';
    }
    else if(iconName == "gift-outline"){
        //gift
        return '<ion-icon name="gift-outline"></ion-icon>';
    }
    else if(iconName == "paw-outline"){
        //pets
        return '<ion-icon name="paw-outline"></ion-icon>';
    }
    else if(iconName == "barbell-outline"){
        //gym
        return '<ion-icon name="barbell-outline"></ion-icon>';
    }
    else if(iconName == "cash-outline"){
        //tax
        return '<ion-icon name="cash-outline"></ion-icon>';
    }
    else if(iconName == "add-circle-outline"){
        //other
        return '<ion-icon name="add-circle-outline"></ion-icon>';
    }
}

let getHtagDescription = function(iconName){
    if(iconName == "fast-food-outline"){
        //food
        return 'food';
    }
    else if(iconName == "water-outline"){
        //utilities
        return 'utilities';
    }
    else if(iconName == "bag-outline"){
        //shopping
        return 'shopping';
    }
    else if(iconName == "train-outline"){
        //transportation
        return 'transportation';
    }
    else if(iconName == "phone-portrait-outline"){
        //phone bills
        return 'phone bills';
    }
    else if(iconName == "game-controller-outline"){
        //entertainment
        return 'entertainment';
    }
    else if(iconName == "home-outline"){
        //housing bills
        return 'home bills';
    }
    else if(iconName == "airplane-outline"){
        //travel
        return 'travel bills';
    }
    else if(iconName == "medkit-outline"){
        //medical aid
        return 'medical aid';
    }
    else if(iconName == "school-outline"){
        //school fees
        return 'education';
    }
    else if(iconName == "gift-outline"){
        //gift
        return 'gift';
    }
    else if(iconName == "paw-outline"){
        //pets
        return 'pets';
    }
    else if(iconName == "barbell-outline"){
        //gym
        return 'gym';
    }
    else if(iconName == "cash-outline"){
        //tax
        return 'tax';
    }
    else if(iconName == "add-circle-outline"){
        //other
        return 'other';
    }
}

let addNewExpense = function(){
    if(globalUserBudget == 0){
       alert("please add a budget first");
    }
    else if(globalUserBudget > 0){
        let getAddNewSection = document.querySelector(".selectNewExpense");
        getAddNewSection.style.visibility = "visible";
    }
}

let closeSection = function(){
    let getAddNewSection = document.querySelector(".selectNewExpense");
    getAddNewSection.style.visibility = "hidden";
}

let updateNumbersonPage = function(){
    document.querySelector(".first-half2 h2").innerHTML = "$" + globalMoneyLeft + " left";
    counterForMoneySpentPercentage = 0;
    counterForMoneyLeftPercentage = 0;
    globalMoneySpentPercentage = (globalMoneySpent/globalUserBudget)*100;
    globalMoneyLeftPercentage = (globalMoneyLeft/globalUserBudget)*100;
    globalcounterForMoneySpentPercentage = setInterval(displayMoneySpentPercentage, 50);
    globalcounterForMoneyLeftPercentage = setInterval(displayMoneyLeftPercentage, 50);
}

//officially creating the new expense
let addExpense = function(iconName){
    let getIcon = document.querySelectorAll(".expense ion-icon");

    for(let i = 0; i < getIcon.length; ++i){
        if(getIcon[i].name == iconName){
            alert("this expense already exists. Delete it first to create a new one");
            return;
        }
    }

    let getAddNewSection = document.querySelector(".selectNewExpense");
    getAddNewSection.style.visibility = "hidden";

    let getPriceSection = document.querySelector(".priceSection");
    getPriceSection.style.visibility = "visible";
    globalNameOfExpense = iconName;
}

//functions which also communicate with the server
let submitPrice = function(){
    let getSubmittedPrice = document.getElementById("newPrice").value;
    if(!(getSubmittedPrice > 0) && !(getSubmittedPrice <= 10000000)){
        alert("this is an inavlid value");
        return;
    }
    let getPriceSection = document.querySelector(".priceSection");
    getPriceSection.style.visibility = "hidden";

    let getAddNewExpense = document.querySelector(".add-new-expense");
    let newExpenseToAdd = document.createElement("div");
    newExpenseToAdd.className = "tempholder";

    newExpenseToAdd.innerHTML = '<div class="expense">'
                            + getIconHTML(globalNameOfExpense)
                            +'<h1>' + getHtagDescription(globalNameOfExpense) + '<br>$' + getSubmittedPrice + '</h1>'
                            +'</div>';
    getAddNewExpense.insertAdjacentHTML("afterend", newExpenseToAdd.innerHTML);

    //updating numbers on page
    globalMoneySpent = globalMoneySpent + parseInt(getSubmittedPrice);
    document.querySelector(".first-half1 h2").innerHTML = "$" + globalMoneySpent;
    globalMoneyLeft = globalMoneyLeft - parseInt(getSubmittedPrice);
    updateNumbersonPage();

    //go to php file using ajax and put in database and changing chart array
    let newDate = new Date();
    let ExpenseReportVariable = "icon=" + globalNameOfExpense + "&price=" + getSubmittedPrice + "&date=" + newDate.getDate();
    xValues.push(newDate.getDate());
    yValues.push(getSubmittedPrice);
    displayChart();
    console.log(ExpenseReportVariable);

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function (){
        console.log(this.responseText);
    };

    xmlhttp.open("POST", "controller.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(ExpenseReportVariable);
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

let changeBudget = function(){
    let getNewBudget = document.getElementById("newBudget").value;

    if(getNewBudget >= 0 && getNewBudget <= 1000000000){
        document.querySelector(".budgeted-amount h2").innerHTML = "$" + getNewBudget;
        globalUserBudget = getNewBudget;
        globalMoneyLeft = getNewBudget - globalMoneySpent;
        updateNumbersonPage();

        //go to php file using ajax and put in database//update session global user budget and money left
        let newBudgetVariables = "budget=" + getNewBudget + "&moneyleft=" + globalMoneyLeft;

        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function (){
            console.log(this.responseText);
        };

        xmlhttp.open("POST", "controller.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(newBudgetVariables);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
    else{
        alert("that is not a valid value, please try again");
    }  
}

let deleteExpense = function(indexNum){
    let getIcon = document.querySelectorAll(".expense-line-form ion-icon");
    document.querySelectorAll(".expense-line-form")[indexNum].remove();

    let getAllExpenseLineFormPtags = document.querySelectorAll(".expense-line-form p");

    for(let i = 0; i < getAllExpenseLineFormPtags.length; ++i){
        getAllExpenseLineFormPtags[i].innerHTML = '<p>'+ (i + 1) +'</p>';
    }
    let getAllExpenses = document.querySelectorAll(".expense-line-form h4");

    for(let i = 0; i < getAllExpenses.length; ++i){
        getAllExpenses[i].innerHTML = '<h4 onclick="deleteExpense('+ i +')">delete</h4>';
    }

    let indexToAccess = indexNum + xValues.length - ((indexNum*2) + 1);
    let priceValueToChange = yValues[indexToAccess];
    let dateAdded = xValues[indexToAccess];

    //updating numbers on page
    globalMoneySpent = globalMoneySpent - parseInt(priceValueToChange);
    document.querySelector(".first-half1 h2").innerHTML = "$" + globalMoneySpent;
    globalMoneyLeft = globalMoneyLeft + parseInt(priceValueToChange);
    updateNumbersonPage();

    xValues.splice(indexToAccess,1);
    yValues.splice(indexToAccess,1);
    console.log(indexNum);
    console.log(indexToAccess);
    console.log(xValues);
    displayChart();

    let dataToDeleteDescription = "icondelete=" + getIcon[indexNum].name + "&pricedelete=" + priceValueToChange + "&datedelete=" + dateAdded;
    
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function (){
        console.log(this.responseText);
    };

    xmlhttp.open("POST", "controller.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(dataToDeleteDescription);
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

</script>