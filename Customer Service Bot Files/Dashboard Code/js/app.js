 $(document).ready(function(){
    $.ajax({
        url:"https://hotelappdashboard.000webhostapp.com/pages/countComplaints.php",
        method: "GET",
        success: function(data){
            console.log(data);
            var values = [];

            for(var i in data){
                values.push(data[i]);
            }

            var ctx2 = document.getElementById("myChart2");
            Chart.defaults.scale.ticks.beginAtZero = true;
            let chart2 = new Chart(ctx2, {
                type: 'bar',
                data:{
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: "Complaints per month",
                        backgroundColor: 'rgb(90, 250, 122)',
                        borderColor: 'rgb(0, 255, 0)',
                        borderWidth: 2,
                        data: values
                    }]
                }
            });
        },
        function(error){
            console.log(data);
        }
    });

    $.ajax({
         url:"https://hotelappdashboard.000webhostapp.com/pages/countOrders.php",
        method: "GET",
        success: function(data){
            console.log(data);
            var values = [];

            for(var i in data){
                values.push(data[i]);
                console.log(values[i]);
            }

            var ctx = document.getElementById("myChart");
            Chart.defaults.scale.ticks.beginAtZero = true;
            let chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',

                // The data for our dataset
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                    datasets: [{
                        label: "Orders per month",
                        backgroundColor: 'rgb(250, 90, 122)',
                        borderColor: 'rgb(255, 29, 62)',
                        borderWidth: 2,
                        data: values
                    }]
                }

                // Configuration options go here
                //options: {}
            });

        },
        function(error){
            console.log(data);
        }
    });
});