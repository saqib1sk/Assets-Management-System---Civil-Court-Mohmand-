$(document).ready(function(){
	$.ajax({
		url: "http://localhost/biotaaox_lab/pages/administrator/bar_chart_code/data.php",
		method :"GET",
		success : function(data){
			console.log(data);
			 data = JSON.parse(data);
            // alert(data);

			var test_name = [];
			var test_count = [];

			for(var i in data){
				test_name.push(data[i].test_name);
				test_count.push(data[i].test_count);

			}
			var chartdata = {
				labels : test_name,

datasets: [{
            label: 'Repeated',
            data: test_count,
            backgroundColor: [
                'rgba(255, 99, 132, 2)',
                'rgba(54, 162, 235, 2)',
                'rgba(255, 206, 86, 2)',
                'rgba(75, 192, 192, 2)',
                'rgba(153, 102, 255, 2)',
                'rgba(255, 159, 64, 2)',
                'rgba(157, 8, 226, 2)',
                'rgba(57, 218, 145, 2)',
                'rgba(57, 218, 255, 2)',
                'rgba(117, 116, 124, 2)',
                'rgba(175, 0, 35, 2)',
                'rgba(0, 165, 244, 2)',
                'rgba(0, 0, 244, 2)',
                'rgba(99, 665, 668, 2)',
                'rgba(54, 343, 234, 2)',
                'rgba(67, 222, 455, 2)',
                'rgba(213, 433, 22, 2)',
                
            ],
           
            //borderWidth: 2
        }]
			};
			var ctx = $("#myChart");
			var barGraph = new Chart(ctx, {
				type : 'bar',
				data : chartdata
			});
		},

		error : function(data){
			console.log(data);
		}
	});
});

































// $(document).ready(function(){
//     $.ajax({
//         url:"http://localhost/ams/bar_chart_code/data.php",
//         method: "GET",
//         success: function(data){
//             console.log(data);
//             var b_type = [];
//             var number = [];

//             for(var i in data){
//                 b_type.push("BT " + data[i].uc);
//                 number.push(data[i].applicants);
//             }

//             var chart = {
//                 labels: b_type,
//                 datasets: [
//                     {
//                         label: b_type,
//                         backgroundColor: 'rgba(200,200,200,0.75)',
//                         borderColor: 'rgba(200,200,200,0.75)',
//                         hoverBackgroundColor: 'rgba(200,200,200,1)',
//                         hoverBorderColor: 'rgba(200,200,200,1)',
//                         data: number
//                     }
//                 ]
//             };

//             var ctx = $("#myChart");

//             var barGraph = new Chart(ctx, {
//                 type: 'bar',
//                 data: chart
//             });

//         },
//         error: function(data){
//             console.log(data);
//         }
//     })
// });