


// alert(elem);
function print150x150() {    
    var divContents = document.getElementById("print_150x150").innerHTML;
    var a = window.open('', '', 'height=720px, width=1200px');
    a.document.write('<html>');
    a.document.write('<head>');
    a.document.write('<title>QR-4x4cm</title>');
    a.document.write('<script>window.onload = function () {alert("function called...");}</script>')
    a.document.write('</head>');
    a.document.write('<body onload="window.print()">');
    a.document.write(divContents);
    a.document.write('<h4 style="font-family: sans-serif; font-size: 16px; padding-left: 15px">4cm x 4cm</h4><br></body></html>');
    a.document.close();
}

function print200x200() {    
    var divContents = document.getElementById("print_200x200").innerHTML;
    var a = window.open('', '', 'height=720px, width=1200px');
    a.document.write('<html>');
    a.document.write('<head>');
    a.document.write('<title>QR-5x5cm</title>');
    a.document.write('<script>window.onload = function () {console.log("function called...");}</script>')
    a.document.write('</head>');
    a.document.write('<body onload="window.print()">');
    a.document.write(divContents);
    a.document.write('<h4 style="font-family: sans-serif; font-size: 16px; padding-left: 15px">5cm x 5cm</h4><br></body></html>');
    a.document.close();
}

function print150x150_cut() {    
    var divContents = document.getElementById("print_150x150").innerHTML;
    var a = window.open('', '', 'height=720px, width=1200px');
    a.document.write('<html>');
    a.document.write('<head><title>QR-4x4cm</title></head>');
    a.document.write('<body onload="window.print()">');
    for (i=0; i<=24; i++){
        a.document.write(divContents);
    }
    a.document.write('</body></html>');
    a.document.close();
}

function print200x200_cut() {    
    var divContents = document.getElementById("print_200x200").innerHTML;
    var a = window.open('', '', 'height=720px, width=1200px');
    a.document.write('<html>');
    a.document.write('<head><title>QR-5x5cm</title></head>');
    a.document.write('<body onload="window.print()">');
    for (i=0; i<=14; i++){
        a.document.write(divContents);
    }
    a.document.write('</body></html>');
    a.document.close();
}

