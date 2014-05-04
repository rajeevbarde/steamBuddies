$(document).ready(function () {

X1 = $("#me").offset().left;  
Y1 = $("#me").offset().top;  

var numFriends = $('.revolve').length;
var orbits = new Array(numFriends-1);

  init();

  function init()
  {              

   for (var i = 0; i < numFriends; i++) 
        {
            orbits[i] = new orbit(X1,Y1,((i*10)+50),getRandomInt(1,360));            
        } 
            
    setInterval(animate,33);     
  }

  function animate()
  {   

      dX = $("#me").offset().left;  
      dY = $("#me").offset().top;  

     for (var i = 0; i < numFriends; i++)  
        {
            orbits[i].getNextXY(dX,dY);
            $("#friend"+(i+1)).css({position:'absolute',top: orbits[i].nextY + 'px', left: orbits[i].nextX+ 'px'});
        } 
  }

  function getRandomInt(min, max)
   {
    return Math.floor(Math.random() * (max - min + 1)) + min;
    }

  /*
http://api.jquery.com/offset/
http://stackoverflow.com/questions/6288153/jquery-trigonmetry
http://jsfiddle.net/6kdkg/
http://www.mathopenref.com/coordparamcircle.html


  */
  
});

  /*
    FUNCTIONS
  */

function orbit(orgX,orgY,rad,sdeg) {

    this.originX = orgX;
    this.originY = orgY;
    this.radius = rad,
    this.randomX= null,
    this.randomY= null,    
    this.nextX = null,
    this.nextY = null,
    this.startDegree = sdeg;
    this.degree = null;    

    this.getRandomCordinateByRadius = function () {      
      this.randomX = Math.floor((Math.random() * ((this.originX+this.radius) - (this.originX-this.radius) + 1)) + (this.originX-this.radius));      
      this.randomY = this.originY  + (Math.random() < 0.5 ? -1 : 1) *  Math.floor(Math.sqrt(Math.pow(this.radius,2) - Math.pow((this.randomX-this.originX),2 )));             
    }     

    this.getNextXY = function (dOriginX,dOriginY) {
      this.degree = (this.startDegree == 360)?this.startDegree = 0:this.startDegree++;
      this.nextX = dOriginX + (rad*Math.cos(this.degree*Math.PI/180));
      this.nextY = dOriginY - (rad*Math.sin(this.degree*Math.PI/180));

    }     
}; 
