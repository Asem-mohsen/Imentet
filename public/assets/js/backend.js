$(function () {
  "use strict";

// Class Active
$(document).ready(function() {
  $('nav ul li').click(function() {
      $('nav ul li').removeClass('current');
      $(this).addClass('current');
  });
  });


      var currentUrl = window.location.href;
          $('nav ul li a').each(function() {
          if ($(this).attr('href') === currentUrl) {
              $(this).parent().addClass('current');
          }
          });

// Dashbord + icon 
$('.toggle-info').click(function(){

  $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);

  if($(this).hasClass('selected')){
  
    $(this).html('<i class="fa fa-plus fa-lg"></i>');
  
  }else{
    $(this).html('<i class="fa fa-minus fa-lg"></i>');
  }
})


  //Hide placeholder when foucs

  $("[placeholder]")
    .focus(function () {
      $(this).attr("data-text", $(this).attr("placeholder"));
      $(this).attr("placeholder", "");
    })
    .blur(function () {
      $(this).attr("placeholder", $(this).attr("data-text"));
    });

  // Add * on Required fileds
  $('input').each(function () {
    if ($(this).attr('required') === 'required') {
        $(this).after('<span class="asterisk"> * </span>');
    }
  });

  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 4,
    spaceBetween: 30,
    pagination: {
    el: ".swiper-pagination",
    clickable: true,
    },
});

  //Confirmation message on delete button
  $('.confirm').click(function(){
return confirm('Are You Sure ?');

  });

//Category View Options
$('.cat h3').click(function(){

  $(this).next('.full-view').fadeToggle(200);
});

$('.options span').click(function(){

  $(this).addClass('active').siblings('span').removeClass('active');
  if($(this).data('view') === 'Full'){
    $('.cat .full-view').fadeIn(200);
  }else{
    $('.cat .full-view').fadeOut(200);
  }

});


  //show delete button when hover

  $('.sub-name').hover(function(){
    $(this).find('.show-delete').fadeIn(400);
  }, function(){

    $(this).find('.show-delete').fadeOut(300);
  });




$(document).ready(function(){
  $('.increament-btn').click(function(e){
    e.preventDefault();
    var quantity = $(this).closest('.product-data').find('.input-quantity').val();
    var value = parseInt(quantity , 10);
    value = isNaN(value) ? 0 : value ;
    if(value < 10 ){
        value++;
        $(this).closest('.product-data').find('.input-quantity').val(value);
    }
  })
  $('.decreament-btn').click(function(e){
    e.preventDefault();
    var quantity = $(this).closest('.product-data').find('.input-quantity').val();
    var value = parseInt(quantity , 10);
    value = isNaN(value) ? 0 : value ;
    if(value > 1 ){
        value--;
        $(this).closest('.product-data').find('.input-quantity').val(value);
    }
  })
});





  // Chart on Dashboard Page
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  
      //Pie Chart

      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Pizza');
        data.addColumn('number', 'Populartiy');
        data.addRows([
        ['Entertainments', 41],
        ['Visits', 21],
        ['Giftshop', 22],
        ['Sponsores', 16], // Below limit.

        ]);

        var options = {
        title: 'Revenue Streams',
        sliceVisibilityThreshold: .2
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);

        }
  });


//Search

  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.querySelectorAll("#TableData");
    for (i = 0; i < tr.length; i++) {
      const tableData = tr[i].getElementsByTagName("td");
      let allTextContent = '';
      for (let ind = 0; ind < tableData.length; ind++) {
          allTextContent += tableData[ind].innerText;
      }
      
      if (allTextContent) {
        if (allTextContent.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }


// Image Updload in Admin Profile

document.getElementById('AdminImage').onchange = function(){
  document.getElementById('image').src = URL.createObjectURL(AdminImage.files[0]); //Preview New Image

  document.getElementById('Cancel').style.display = "block";
  document.getElementById('Confirm').style.display = "block";
  document.getElementById('upload').style.display = "none";
}
var AdminImg = document.getElementById('image').src ;
document.getElementById('Cancel').onclick = function(){
  document.getElementById('image').src = AdminImg ;      // Back to previous Image

  document.getElementById('Cancel').style.display = "none";
  document.getElementById('Confirm').style.display = "none";
  document.getElementById('upload').style.display = "block";
}




