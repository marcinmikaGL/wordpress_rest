$(document).ready(function() {
    // Activate Carousel
    $("#przykladowaKaruzela4").carousel();

    // Enable Carousel Indicators
    $(".item1").click(function() {
        $("#przykladowaKaruzela4").carousel(0);
    });
    $(".item2").click(function() {
        $("#przykladowaKaruzela4").carousel(1);
    });
    $(".item3").click(function() {
        $("#przykladowaKaruzela4").carousel(2);
    });
    $(".item4").click(function() {
        $("#przykladowaKaruzela4").carousel(3);
    });

    $(".item5").click(function() {
        $("#przykladowaKaruzela4").carousel(4);
    });

    $(".item6").click(function() {
        $("#przykladowaKaruzela4").carousel(5);
    });
    $(".item7").click(function() {
        $("#przykladowaKaruzela4").carousel(5);
    });

    // Enable Carousel Controls
    $(".left").click(function() {
        $("#myCarousel").carousel("prev");
    });
    $(".right").click(function() {
        $("#myCarousel").carousel("next");
    });
});