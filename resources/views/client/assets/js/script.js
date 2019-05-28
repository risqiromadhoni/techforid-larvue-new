"use strict";
$(document).ready(function(){
  var navHeight = $('#myHeader').offset().top;
  $(window).scroll(function(){
    if ($(window).scrollTop() > navHeight) {
      $("#myHeader").addClass("fixed").slideDown('slow');
    }
    else {
      $("#myHeader").removeClass("fixed");
    }
 });

 // modal test
 $(window).on('load',function(){
      $('.modal-test').modal('show');
  }); 

 // multiple select
  var spacesToAdd = 8;
  var biggestLength = 0;
  $("#timezones option").each(function(){
  var len = $(this).text().length;
      if(len > biggestLength){
          biggestLength = len;
      }
  });
  var padLength = biggestLength + spacesToAdd;
  $("#timezones option").each(function(){
      var parts = $(this).text().split('+');
      var strLength = parts[0].length;
      for(var x=0; x<(padLength-strLength); x++){
          parts[0] = parts[0]+' '; 
      }
      $(this).text(parts[0].replace(/ /g, '\u00a0')+''+parts[1]).text;
  });
  
});


function includeHTML() {
  var z, i, elmnt, file, xhttp;
  /*loop through a collection of all HTML elements:*/
  z = document.getElementsByTagName("*");
  for (i = 0; i < z.length; i++) {
    elmnt = z[i];
    /*search for elements with a certain atrribute:*/
    file = elmnt.getAttribute("w3-include-html");
    if (file) {
      /*make an HTTP request using the attribute value as the file name:*/
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
          if (this.status == 200) {elmnt.innerHTML = this.responseText;}
          if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
          /*remove the attribute, and call this function once more:*/
          elmnt.removeAttribute("w3-include-html");
          includeHTML();
        }
      }
      xhttp.open("GET", file, true);
      xhttp.send();
      /*exit the function:*/
      return;
    }
  }
};
