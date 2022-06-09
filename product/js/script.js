//For Switching Tabs 

var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
triggerTabList.forEach(function (triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', function (event) {
    event.preventDefault()
    tabTrigger.show()
  })
})

//For data table 

$(document).ready(function() {
  $('#showquestion').DataTable();
} );

$(document).ready(function() {
  $('#showreview').DataTable();
} );
//For providing Rating Stars 
function changingstarcolor(starid){
    var newstar = starid
   if(newstar == 'star1'){

    document.getElementById('s1').style.color = '#f4bc5c'
    document.getElementById('s2').style.color = 'black'
    document.getElementById('s3').style.color = 'black'
    document.getElementById('s4').style.color = 'black'
    document.getElementById('s5').style.color = 'black'
    document.getElementById('s6').style.color = 'black'
    document.getElementById('s7').style.color = 'black'
    document.getElementById('s8').style.color = 'black'
    document.getElementById('s9').style.color = 'black'
    document.getElementById('s10').style.color = 'black'
    document.getElementById('s11').style.color = 'black'
    document.getElementById('s12').style.color = 'black'
    document.getElementById('s13').style.color = 'black'
    document.getElementById('s14').style.color = 'black'
    document.getElementById('s15').style.color = 'black'
    
   }
   else if(newstar == 'star2'){

    document.getElementById('s1').style.color = 'black'
    document.getElementById('s2').style.color = '#f4bc5c'
    document.getElementById('s3').style.color = '#f4bc5c'
    document.getElementById('s4').style.color = 'black'
    document.getElementById('s5').style.color = 'black'
    document.getElementById('s6').style.color = 'black'
    document.getElementById('s7').style.color = 'black'
    document.getElementById('s8').style.color = 'black'
    document.getElementById('s9').style.color = 'black'
    document.getElementById('s10').style.color = 'black'
    document.getElementById('s11').style.color = 'black'
    document.getElementById('s12').style.color = 'black'
    document.getElementById('s13').style.color = 'black'
    document.getElementById('s14').style.color = 'black'
    document.getElementById('s15').style.color = 'black'

   }
   else if(newstar == 'star3'){
     
    document.getElementById('s1').style.color = 'black'
    document.getElementById('s2').style.color = 'black'
    document.getElementById('s3').style.color = 'black'
    document.getElementById('s4').style.color = '#f4bc5c'
    document.getElementById('s5').style.color = '#f4bc5c'
    document.getElementById('s6').style.color = '#f4bc5c'
    document.getElementById('s7').style.color = 'black'
    document.getElementById('s8').style.color = 'black'
    document.getElementById('s9').style.color = 'black'
    document.getElementById('s10').style.color = 'black'
    document.getElementById('s11').style.color = 'black'
    document.getElementById('s12').style.color = 'black'
    document.getElementById('s13').style.color = 'black'
    document.getElementById('s14').style.color = 'black'
    document.getElementById('s15').style.color = 'black'
   }

   else if (newstar == 'star4'){
     
    document.getElementById('s1').style.color = 'black'
    document.getElementById('s2').style.color = 'black'
    document.getElementById('s3').style.color = 'black'
    document.getElementById('s4').style.color = 'black'
    document.getElementById('s5').style.color = 'black'
    document.getElementById('s6').style.color = 'black'
    document.getElementById('s7').style.color = '#f4bc5c'
    document.getElementById('s8').style.color = '#f4bc5c'
    document.getElementById('s9').style.color = '#f4bc5c'
    document.getElementById('s10').style.color = '#f4bc5c'
    document.getElementById('s11').style.color = 'black'
    document.getElementById('s12').style.color = 'black'
    document.getElementById('s13').style.color = 'black'
    document.getElementById('s14').style.color = 'black'
    document.getElementById('s15').style.color = 'black'

   }
   else if(newstar == 'star5'){
     
    document.getElementById('s1').style.color = 'black'
    document.getElementById('s2').style.color = 'black'
    document.getElementById('s3').style.color = 'black'
    document.getElementById('s4').style.color = 'black'
    document.getElementById('s5').style.color = 'black'
    document.getElementById('s6').style.color = 'black'
    document.getElementById('s7').style.color = 'black'
    document.getElementById('s8').style.color = 'black'
    document.getElementById('s9').style.color = 'black'
    document.getElementById('s10').style.color = 'black'
    document.getElementById('s11').style.color = '#f4bc5c'
    document.getElementById('s12').style.color = '#f4bc5c'
    document.getElementById('s13').style.color = '#f4bc5c'
    document.getElementById('s14').style.color = '#f4bc5c'
    document.getElementById('s15').style.color = '#f4bc5c'
   }
}

