function reqListener() {
    const json = JSON.parse(this.responseText);

    // Sorting menu by alphabetical basis
    
    // https://davidsimpson.me/2014/05/22/how-to-sort-an-array-of-json-arrays/
    function sortByProperty(property) {
        return function (x, y) {
            return ((x[property] === y[property]) ? 0 : ((x[property] > y[property]) ? 1 : -1));
        };
    };
    
    const items = json.Menu.food.sort(sortByProperty("name"));
    
    for(var i=0; i<items.length; i++) {
        var object = items[i];
        document.getElementById("menuSorted").innerHTML += "<li>" + object.name + "</li>";
    }

    // Filtering menu items under $6
    // https://stackoverflow.com/questions/9483695/filtering-json-data
    var filteredJson = json.Menu.food.filter(function (food) {
        if(parseFloat(food.price) < 7.00) {
            console.log(food.price);
            document.getElementById("menuItems").innerHTML += "<li>" + food.name + ": $" + food.price + "</li>";
        }
    });
}

function reqError(err) {
    console.log('Fetch Error :-S', err);
}

var oReq = new XMLHttpRequest();
oReq.onload = reqListener;
oReq.onerror = reqError;
oReq.open('get', './js/Menu(JSON).json', true);
oReq.send();