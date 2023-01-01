google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);


function drawChart() {
    var numOfRecoveredDaily = parseInt(getCookie("toSend1"));
    var numOfSymptomaticDaily = parseInt(getCookie("toSend2"));

    var numOfRecoveredWeekly = parseInt(getCookie("toSend3"));
    var numOfSymptomaticWeekly = parseInt(getCookie("toSend4"));

    window.setInterval(checkCookie, 100);
    var data = google.visualization.arrayToDataTable([
        ['Status', 'Number'],
        ['Symptomatic', numOfSymptomaticDaily],
        ['Recovered', numOfRecoveredDaily]

    ]);

    var options = {
        backgroundColor: { fill: "#89909E" },
        TextStyle: { color: '#14213D' },
        legend: { position: 'bottom', hoverLabel: { fontSize: 12 } }



    };

    var chart = new google.visualization.PieChart(document.getElementById('piechartdaily'));

    chart.draw(data, options);


    var data1 = google.visualization.arrayToDataTable([
        ['Status', 'Number'],
        ['Symptomatic', numOfSymptomaticWeekly],
        ['Recovered', numOfRecoveredWeekly]
    ]);

    var options1 = {
        backgroundColor: { fill: "#89909E" },
        TextStyle: { color: '#14213D' },
        legend: { position: 'bottom', hoverLabel: { fontSize: 12 } }
    };

    var chart1 = new google.visualization.PieChart(document.getElementById('piechartweekly'));

    chart1.draw(data1, options1);
}
var checkCookie = function() {
    var lastCookie = document.cookie; // 'static' memory between function calls
    return function() {
        var currentCookie = document.cookie;
        if (currentCookie != lastCookie) {
            lastCookie = currentCookie; // store latest cookie
            document.location.reload(); // reload page
        }
    };
}();

function getFirstMondayOfWeek(weekNo) {
    let year = new Date().getFullYear();

    // Test weekNo is an integer in range 1 to 53
    if (Number.isInteger(+weekNo) && weekNo > 0 && weekNo < 54) {

        // Get to Monday of first ISO week of year
        var firstMonday = new Date(year, 0, 4);
        firstMonday.setDate(firstMonday.getDate() + (1 - firstMonday.getDay()));

        // Add required weeks
        firstMonday.setDate(firstMonday.getDate() + 7 * (weekNo - 1));

        // Check still in correct year (e.g. weekNo 53 in year of 52 weeks)
        if (firstMonday.getFullYear() <= year) {
            return firstMonday;
        }
    }
    // If not an integer or out of range, return undefined
    return;
}

//a simple date formatting function
function dateFormat(inputDate, format) {
    //parse the input date
    const date = new Date(inputDate);

    //extract the parts of the date
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    //replace the month
    format = format.replace("MM", month.toString().padStart(2, "0"));

    //replace the year
    if (format.indexOf("yyyy") > -1) {
        format = format.replace("yyyy", year.toString());
    } else if (format.indexOf("yy") > -1) {
        format = format.replace("yy", year.toString().substr(2, 2));
    }

    //replace the day
    format = format.replace("dd", day.toString().padStart(2, "0"));

    return format;
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


window.onload = function() {

    let input = document.getElementById("daily");
    input.addEventListener('change', function() {
        document.cookie = "date=" + input.value + ";";


    });

    let input1 = document.getElementById("weekly");
    input1.addEventListener('change', function() {
        let val = input1.value;
        let myArr = val.split("-");
        let year = myArr[0];
        let week = myArr[1];
        let arr = week.split("");
        let weekToUse = arr[1] + arr[2];
        let weekNo = parseInt(weekToUse);
        let yearToUse = parseInt(year);
        let firstMonday = getFirstMondayOfWeek(weekToUse);
        let temp = new Date(firstMonday);

        let tuesdayDate = temp.setDate(temp.getDate() + 1);
        let wednesdayDate = temp.setDate(temp.getDate() + 1);
        let thursdayDate = temp.setDate(temp.getDate() + 1);
        let fridayDate = temp.setDate(temp.getDate() + 1);
        let saturdayDate = temp.setDate(temp.getDate() + 1);
        let sundayDate = temp.setDate(temp.getDate() + 1);

        let monday = dateFormat(firstMonday, "dd/MM/yyyy");
        let tuesday = dateFormat(tuesdayDate, "dd/MM/yyyy");
        let wednesday = dateFormat(wednesdayDate, "dd/MM/yyyy");
        let thursday = dateFormat(thursdayDate, "dd/MM/yyyy");
        let friday = dateFormat(fridayDate, "dd/MM/yyyy");
        let saturday = dateFormat(saturdayDate, "dd/MM/yyyy");
        let sunday = dateFormat(sundayDate, "dd/MM/yyyy");
        console.log(monday);
        console.log(tuesday);
        console.log(wednesday);
        console.log(thursday);
        console.log(friday);
        console.log(saturday);
        console.log(sunday);
        document.cookie = "monday=" + monday + ";";
        document.cookie = "tuesday=" + tuesday + ";";
        document.cookie = "wednesday=" + wednesday + ";";
        document.cookie = "thursday=" + thursday + ";";
        document.cookie = "friday=" + friday + ";";
        document.cookie = "saturday=" + saturday + ";";
        document.cookie = "sunday=" + sunday + ";";

    });

}