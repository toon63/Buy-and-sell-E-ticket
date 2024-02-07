 <style type="text/css">

  html,
  body,
  #container-1 {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
  }

</style>

<div id="container-1"></div>

<script>

  anychart.onDocumentReady(function () {
      // create line chart
    var chart = anychart.line();

    chart.yScale().minimum(0);

      // create line series
    var series = chart.line(getData());

    series.normal().stroke('#999999', 5, null, 'round', 'round');
    series.normal().risingStroke('#66BB6A', 5, null, 'round', 'round');
    series.normal().fallingStroke('#FF7043', 5, null, 'round', 'round');

      // set container id for the chart
    chart.container('container-1');

      // initiate chart drawing
    chart.draw();
  });

    // return data for chart
  function getData() {
    return [
      ['Jan 2010', 35],
      ['Feb 2010', 45],
      ['Mar 2010', 49],
      ['Apr 2010', 52],
      ['May 2010', 53],
      ['Jun 2010', 58],
      ['Jul 2010', 55],
      ['Aug 2010', 60],
      ['Sep 2010', 50],
      ['Oct 2010', 50],
      ['Nov 2010', 53],
      ['Dec 2010', 56],
      ['Jan 2011', 52],
      ['Feb 2011', 53],
      ['Mar 2011', 52],
      ['Apr 2011', 47],
      ['May 2011', 49],
      ['Jun 2011', 46],
      ['Jul 2011', 48],
      ['Aug 2011', 43],
      ['Sep 2011', 45],
      ['Oct 2011', 45],
      ['Nov 2011', 42],
      ['Dec 2011', 44],
      ['Jan 2012', 43],
      ['Feb 2012', 45],
      ['Mar 2012', 44],
      ['Apr 2012', 38],
      ['May 2012', 43],
      ['Jun 2012', 36],
      ['Jul 2012', 35],
      ['Aug 2012', 29],
      ['Sep 2012', 36],
      ['Oct 2012', 32],
      ['Nov 2012', 38],
      ['Dec 2012', 30]
      ];
  }

</script>