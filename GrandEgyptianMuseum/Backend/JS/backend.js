$(function () {
  "use strict";



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

  //Convert Password INTO showen text
  var PassField = $('.Password');
  $('.show-pass').hover(function(){
  PassField.attr('type' , 'text');
  },function(){
   PassField.attr('type','password');
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










  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 4,
    spaceBetween: 15,
    freeMode: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
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