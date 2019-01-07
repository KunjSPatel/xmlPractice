const express = require("express");
const fs = require("fs");
const x2j = require("xml2js");
const DOMParser = require("xmldom").DOMParser;

const app = express();

const sInputFile = "Menu.xml";
const sInputFileTransformed = "menuTransformed.xml";

app.get("/Menu", function(req, res) {
  fs.readFile(__dirname + "/xml/" + sInputFile, "utf8", (err, data) => {
    console.log(data);
    res.header("Content-Type", "text/xml").send(data);
  });
});

app.get("/menu-json", function(req, res) {
  let p = new x2j.Parser({ explicitArray: false });
  fs.readFile(__dirname + "/xml/" + sInputFileTransformed, "utf8", function(err, data) {
    const xmlStringSerialized = new DOMParser().parseFromString(
      data,
      "text/xml"
    );
    p.parseString(xmlStringSerialized, (err, result) => {
      const s = JSON.stringify(result, undefined, 3);
      res.end(s);
    });
  });
});

const server = app.listen(8081, () => {
  const host = server.address().address;
  const port = server.address().port;
  console.log(`Example app listening at http://localhost:${port}`);
});