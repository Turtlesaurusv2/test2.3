<!DOCTYPE html>
<html>

<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootpag/1.0.7/jquery.bootpag.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {

      load_data();

      function load_data(query = "", page = 1) {

        var data = {};
        data["query"] = query;
        data["page"] = page;


        var query = JSON.stringify(data);


        $.ajax({
          url: "name.php",
          method: "POST",
          data: {
            "query": query
          },
          success: function(data) {
            $('#result').html(data);
          }

        });

      }
      //สร้าง function รับค่า input
      $('#search_text').keyup(function() {
        var search = $(this).val();
        if (search != '') {
          load_data(search);
        } else {
          load_data();
        }
      });


   
    $('#page-selection').bootpag({
        total: 20,
        page: 5,
        maxVisible: 6,
        leaps: false,
        next: 'next',
        prev: null,
      }).on('page', function(event, num) {

        // ajax
        $.ajax({
          url:"name.php",
          type: "POST"
        })
        console.log(num);

        load_data("", num);
        
        });
      });
      function send(id) {

var x = document.getElementById("invoiceBody" + id);
// ajax
$.ajax({
  url: "data_name.php",
  type: "POST",
  data: 'id=' + id,
  success: function(data) {
    if (x.style.display === "none") {
      x.style.display = "block";
      $("#invoiceBody" + id).html(data)
    } else {
      x.style.display = "none";
    }

  }
});

}
  </script>

  <style>
    td,
    th {
      border: 2px solid;
      text-align: center;
      padding: 8px;

    }
  
  </style>
</head>

<body >
  </br>
  
  <div class="container">
  <div>


    <input type="text" name="search_text" id="search_text" placeholder="Search " size="40" style="background-color:#F0FFFF;">

  </div>







 
  
  
  <div id="result"style="padding-top:10px"></div>
  <div id="page-selection"></div>
  </div>

</body>

</html>