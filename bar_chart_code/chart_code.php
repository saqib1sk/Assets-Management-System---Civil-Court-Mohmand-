<script src="bar_chart_code/js/chart.js"></script>
<script src="bar_chart_code/js/jquery.min.js"></script>

<script src="bar_chart_code/js/app.js"></script>
<?php
// Assuming you have a database connection established

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Fetch data from the table
$sql = "SELECT id, name, status FROM child_detail";
$result = mysqli_query($my_connection, $sql);

// Store the fetched data in an array
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
$data[] = $row;
}

// Convert the data array to JSON format
$jsonData = json_encode($data);

// Pass the JSON data to JavaScript
echo "<script>var childData = $jsonData;</script>";
?>

<script>

    

// Adjust the desired height for the graph
var graphHeight = 330; // Set the desired height in pixels


// Assuming you have a JavaScript library for graphing, such as Chart.js

// Create an array to store the count of each status
var statusCount = [0, 0, 0, 0]; // [Active, Pending, Rescued, Deleted]

// Loop through the child data and count the occurrences of each status
for (var i = 0; i < childData.length; i++) {
var status = childData[i].status;
statusCount[status]++;
}



// Set the height of the parent container
document.getElementById('graphContainer').style.height = graphHeight + 'px';



// Generate the graph using the status count data
// Use your preferred graphing library and configure it accordingly
// Here's an example using Chart.js

var ctx = document.getElementById('graphCanvas').getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
data: {
labels: ['Active', 'Pending', 'Rescued', 'Deleted'],
datasets: [{
label: 'Child Status',
data: statusCount,
backgroundColor: ['#34d3eb', '#fb6d9d', '#81c868', '#f05050'],
}]
},
options: {
        // Customize the graph options as needed
        responsive: true,
        maintainAspectRatio: false // Disable maintaining aspect ratio to allow height adjustment
    }
});

</script>
