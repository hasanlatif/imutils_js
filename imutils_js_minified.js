/* -*- coding: utf-8 -*-
Created by: JavaScript
Author :Hasan Latif
Email :hasanlatif.pk@gmail.com
WARNING! All changes made in this file will be lost!
*/

function translation(img,x,y){y=-y;console.log("hasan",y);let translation_matrix=cv.matFromArray(2,3,cv.CV_64FC1,[1,0,x,0,1,y]);let dsize=new cv.Size(img.rows,img.cols);let dst=new cv.Mat();cv.warpAffine(img,dst,translation_matrix,dsize,cv.INTER_LINEAR,cv.BORDER_CONSTANT,new cv.Scalar());return dst}
function rotation(img,angle,center_x=0,center_y=0,scale=1.0){let dsize=new cv.Size(img.rows,img.cols);let dst=new cv.Mat();if(center_x!=0&&center_y!=0){var center=new cv.Point(center_x,center_y)}
else{var center=new cv.Point(img.cols/2,img.rows/2)}
let rotation_matrix=cv.getRotationMatrix2D(center,angle,scale);cv.warpAffine(img,dst,rotation_matrix,dsize);return dst}
function resize(img,width,height){var h=img.rows;var w=img.cols;console.log("h,w",h,w);var width;var dsize=new cv.Size(h,w);var dst=new cv.Mat();if(width==0&&height==0){return img}
if(width==0){r=height/Math.round(h);var width=w*r;var dsize=new cv.Size(width,height);console.log("r",dsize)}
else{r=width/w;var height=Math.round((h*r));var dsize=new cv.Size(width,height);console.log("width_c,height_c,",width,height)}
cv.resize(img,dst,dsize);return[dst,width,height]}