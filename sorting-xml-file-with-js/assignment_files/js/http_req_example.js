function reqListener() {
    var dcmt = this.responseText;
    var xmlDoc;
    if (window.DOMParser)
    {
        parser = new DOMParser();
        xmlDoc = parser.parseFromString(dcmt, "text/xml");
    }
    else // For Internet Explorer
    {
        xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async = false;
        xmlDoc.loadXML(dcmt);
    }

    // Printing all the menu items which are less than $5.00 in bullet form
    var nodes = document.evaluate('/Menu/food[price="$5.00"]/name', xmlDoc, null, XPathResult.ANY_TYPE, null);
    var item = nodes.iterateNext();
    
    //For Bullet form
    var items = "<ul>";

    while(item) {
        items += "<li>" + item.innerHTML + "</li>";
        item = nodes.iterateNext();
    }
    items += "</ul>";

    document.getElementById("menuItems").innerHTML = items;

    // Sorting all items alphabetically by name
    var nodes = document.evaluate('/Menu/food[id="1"]/name', xmlDoc, null, XPathResult.ANY_TYPE, null);
    var item = nodes.iterateNext();
    var itemsArray = [];
    while(item) {
        itemsArray.push("<br>"+item.innerHTML);
        item = nodes.iterateNext();
    }
    console.log(itemsArray.sort());

    // Printing sorted menu items by name
    document.getElementById("menuSorted").innerHTML = itemsArray.sort().toString() +".";

}

function reqError(err) {
    console.log('Fetch Error :-S', err);
}

var oReq = new XMLHttpRequest();
oReq.onload = reqListener;
oReq.onerror = reqError;
oReq.open('get', './xml/Menu.xml', true);
oReq.send();
