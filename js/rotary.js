/*function LoadContent(page) {
	var validPages = ["rotary", "club", "mission", "membres", "inscription"];
	if($.inArray(page, validPages) != -1) {
		var $article = $(".rt-article");
		var $pageToLoad = $('.rt-content[data-page="' + page + '"]');
		$article.empty().append($pageToLoad.html());
		if(page == "inscription") mapInitialize();
	}
}*/

function mapInitialize() {
  var LatLong = new google.maps.LatLng(46.708948, -71.293889);
  var options = {
    zoom: 16,
    center: LatLong,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var map = new google.maps.Map(document.getElementById("mapCanvas"), options);

  var marker = new google.maps.Marker({
    position: LatLong,
    map: map,
    title: "Hôtel Bernières"
  });
}

$(function() {
  //carousel
  $(".carousel").carousel({ interval: 5000 });

  var $links = $(".rt-url");
  var currentLocation = document.URL;
  if (currentLocation.indexOf("club") != -1) {
    var tmp =
      currentLocation.indexOf("#") != -1
        ? currentLocation.split("#")[1]
        : "rotary";
    $links.removeClass("active");
    $('.rt-url[href="#' + tmp + '"]').addClass("active");
    LoadContent(tmp);
  }

  /*$links.click(function() {
		$links.removeClass("active");
		$(this).addClass("active");
		var contentToLoad = this.href.split("#")[1];
		LoadContent(contentToLoad);
	});
	

	$("#rt-club").click(function() { $('.rt-url[href="#club"]').click(); })
	$("#rt-join").click(function() { $('.rt-url[href="#inscription"]').click(); })*/
});
