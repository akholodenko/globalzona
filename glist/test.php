
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
<title>One Hundred Percent height divs</title>
<style type="text/css" media="screen">
body {
margin:0;
padding:0;
height:100%; /* this is the key! */
}
#header {
height: 50px;
background-color: #EAEAEA;
border:1px solid #333;
padding:4px;
}
#left {
position:absolute;
left:0;
top:80px;
padding:0;
width:200px;
height:100%; /* works only if parent container is assigned a height value */
color:#333;
background:#eaeaea;
border:1px solid #333;
}
.content {
position: relative;
top: 30px;
margin-left:220px;
margin-right:220px;
margin-bottom:20px;
color:#333;
background:#ffc;
border:1px solid #333;
padding:0 10px;
}
#right {
position:absolute;
right:0;
top: 80px;
padding:0;
width:200px;
height:100%; /* works only if parent container is assigned a height value */
color:#333;
background:#eaeaea;
border:1px solid #333;
}

#left p {
padding:0 10px;
}
#right p {
padding:0 10px;
}
p.top {
margin-top:20px;
}
</style>
</head>

<body>
<div id="header">
<p>Here is the header: 50px high, no positioning.</p>
</div>

<div id="left">
<p class="top">This design uses a defined body height of 100% which allows setting the
contained left and right divs at 100% height.</p>

</div>

<div class="content">
<p>This design uses a defined body height which of 100% allows setting the contained left and
right divs at 100% height.</p>
</div>

<div class="content">
<p>This design uses a defined body height which of 100% allows setting the contained left and
right divs at 100% height.</p>
</div>

<div class="content">

<p>This design uses a defined body height which of 100% allows setting the contained left and
right divs at 100% height.</p>
</div>

<div id="right">
<p class="top">To solve an inheritance issue displayed in div #right as rendered in Opera, class p.top
using margin-top:20; is applied to the first paragraph of each outer divs.</p>
</div>
</body>
</html> 