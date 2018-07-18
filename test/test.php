<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
			<style>
	
	
		.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* prevent scrollbar from display during load */
body.loading {
    overflow: hidden;   
}

/* display the modal when loading class is added to body */
body.loading .modal {
    display: block;
}
	
	hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
	border-color:black;
}


.vl {
    border-left: 6px dashed green;
    height: 20%;
}
.hor1 {
    border-bottom: 6px dashed green;
    height: 30%;

}
	</style>
		
		
		
        <title>Upload Canvas Data to PHP Server</title>
    </head>
    <body>
	<div class="modal">
	
	
	
	</div>
	
        
        <form method="post" accept-charset="utf-8" name="form1">
	
	
	<table align="center" border="2">
	
		<tr>
			<td colspan="3" align="center">
			<h4 align="center">Orignal Image<h4>
				 <hr/>
				<br/>
				<br/>
			
				 <div class="vl"><div style="display:inline">
                     <img id="imageSrc" alt="No Image"/>
					 
						x-axis
					</div></div>
				 <hr style="border-style:dashed;border-color:green;"/>
				 <input type="file" id="fileInput" name="file" />
				
			
			</td>
		
		
		</tr>
		
		
		<tr>
			<td><h4 align="center">Translated Image<span id="translation_span"></span><h4>
				 <hr/>
				 <div class="vl"><div style="display:inline">
					 <canvas id="canvas"></canvas>

                 </div></div>
             <hr style="border-style:dashed;border-color:green;"/>
			  <div align="center" style="margin-top:2px;">   x-axis<div>
			 
			 </td>
			
			<td><h4 align="center">Rotated Image<span id="rotation_span"></span><h4>
				 <hr/>
				  <div class="vl"><div style="display:inline">
				 <canvas id="rotation"></canvas>
				 </div></div>
				 <hr style="border-style:dashed;border-color:green;"/>
				           <div align="center" style="margin-top:2px;">   x-axis<div>
				</td>
			<td> <h4 align="center">Resized Image<br/><span id="resized_span"></span><h4>
				 <hr/>
				  <div class="vl"><div style="display:inline">
				 <canvas id="resize"></canvas>
				 </div></div>
				
				 <hr style="border-style:dashed;border-color:green;"/>
				 <div align="center" style="margin-top:2px;">   x-axis<div>
				 
				 </td>
					
		
		</tr>
		
	
	
	</table>
	  
	  
	 </form>
 <script async src="../includes/opencv.js" onload="onOpenCvReady();" type="text/javascript"></script>
<script  type="text/javascript" async src="imutils_js_minified.js"></script>
<script type="text/javascript">
//	
document.body.classList.add("loading");
function onOpenCvReady() {
document.body.classList.remove("loading");

let imgElement = document.getElementById('imageSrc');
let inputElement = document.getElementById('fileInput');
//let bElement = document.getElementById('sub1');

inputElement.onchange = function() {
  imgElement.src = URL.createObjectURL(event.target.files[0]);
};
imgElement.onload= function() {

var image = cv.imread(imgElement);//reading image
let dst= new cv.Mat();    //allocating memory area for resulting image
//dst = translation(image,25,-75);
/*
Below code is for translation of images.use standard coordinate system to translate the image as you use in standard.
i.e.  Ist quadrant: top-right  (x=+ive,y=+ive)
	   II quadrant : top-left   (x=-ive,y=+ive)
	   III quadrant: bottom-left (x=-ive,y=-ive)
	   IV quadrant: bottom-right  (x=+ive,y=-ive)
*/

x=45;y=60;  //x:translation along x-axis,y:translation along y-axis
dst = translation(image,x,y);  //function from imutils_js
document.getElementById("translation_span").innerHTML="<br/>x:"+x+",y:"+y;  //writing (x,y) in html
cv.imshow('canvas',dst);// showing translated image

/*Below code is for testing rotation function in imutils_js.
This is the case where i am not providing the center about where to rotate.
*/

angle=270;   ///rotation
dst1 = rotation(image,angle);//function call from imutils_js
document.getElementById("rotation_span").innerHTML="<br/> &#8736; ="+angle+" &#186";//writing html
cv.imshow('rotation',dst1);//showing rotated image 
/*

Below code is for testing resize function in imutils_js.
This is the case where i am not providing the width and height is calculated by taking care of aspect ratio.
you can only provide the height  to get width automatically
call this function as 
resize(image,width=0,height=30);
or provide the width and height for this case you have to take care of aspect ratio by your self.
*/

width=250;  //width of result image 
height=0   //initializing height
f = resize(image,width,height);  //function call from imutils_js
/*
resize function returns array in this order 
image,width of resulting image,height of resulting image
*/
dst2=f[0];  
w=f[1];
h=f[2];

/*
 below code is for Writing html

*/
if(width==0){
document.getElementById("resized_span").innerHTML="\ncalculated width: "+width+"height:"+height;
}
if(height==0){	
document.getElementById("resized_span").innerHTML="calculated height:"+h+"width:"+width;	
}
else{
	document.getElementById("resized_span").innerHTML="\nwidth = "+width+"height = "+height;
	}
cv.imshow('resize',dst2);  //showing resized image
/*free up the memory space*/
dst.delete();  
dst1.delete();
dst2.delete();
image.delete();
};
}




</script>

    </body>
	


</html>