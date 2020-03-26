<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/survey-jquery/survey.min.css">
  </head>
  <body>
    <div class="container">
        <div id="surveyElement" style="display:inline-block;width:100%;"></div>
        <div id="surveyResult"></div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://unpkg.com/survey-jquery"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>

Survey
    .StylesManager
    .applyTheme("boostrap");

    var json = {
        "pages": [
            {
                "name": "page1",
                "elements": [
                    {
                        "type": "rating",
                        "name": "satisfaction",
                        "title": "How satisfied are you with the Product?",
                        "mininumRateDescription": "Not Satisfied",
                        "maximumRateDescription": "Completely satisfied"
                    }, {
                        "type": "panel",
                        "innerIndent": 1,
                        "name": "panel1",
                        "title": "Please, help us improve our product",
                        "visibleIf": "{satisfaction} < 3",
                        "elements": [
                            {
                                "type": "checkbox",
                                "choices": [
                                    {
                                        "value": "1",
                                        "text": "Customer relationship"
                                    }, {
                                        "value": "2",
                                        "text": "Service quality"
                                    }, {
                                        "value": "3",
                                        "text": "Support response time"
                                    }
                                ],
                                "name": "What should be improved?"
                            }, {
                                "type": "comment",
                                "name": "suggestions",
                                "title": "What would make you more satisfied with the Product?"
                            }, {
                                "type": "panel",
                                "innerIndent": 1,
                                "name": "panel2",
                                "title": "Send us your contact information (optionally)",
                                "state": "collapsed",
                                "elements": [
                                    {
                                        "type": "text",
                                        "name": "name",
                                        "title": "Name:"
                                    }, {
                                        "type": "text",
                                        "inputType": "email",
                                        "name": "email",
                                        "title": "E-mail"
                                    }
                                ]
                            }
                        ]
                    }
                ]
            },
            {
                "name": "page2",
                "elements": [
                    {
                        "type": "rating",
                        "name": "satisfaction",
                        "title": "How satisfied are you with the Product?",
                        "mininumRateDescription": "Not Satisfied",
                        "maximumRateDescription": "Completely satisfied"
                    }, {
                        "type": "panel",
                        "innerIndent": 1,
                        "name": "panel1",
                        "title": "Please, help us improve our product",
                        "visibleIf": "{satisfaction} < 3",
                        "elements": [
                            {
                                "type": "checkbox",
                                "choices": [
                                    {
                                        "value": "1",
                                        "text": "Customer relationship"
                                    }, {
                                        "value": "2",
                                        "text": "Service quality"
                                    }, {
                                        "value": "3",
                                        "text": "Support response time"
                                    }
                                ],
                                "name": "What should be improved?"
                            }, {
                                "type": "comment",
                                "name": "suggestions",
                                "title": "What would make you more satisfied with the Product?"
                            }, {
                                "type": "panel",
                                "innerIndent": 1,
                                "name": "panel2",
                                "title": "Send us your contact information (optionally)",
                                "state": "collapsed",
                                "elements": [
                                    {
                                        "type": "text",
                                        "name": "name",
                                        "title": "Name:"
                                    }, {
                                        "type": "text",
                                        "inputType": "email",
                                        "name": "email",
                                        "title": "E-mail"
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }
        ]
    };

window.survey = new Survey.Model(json);

survey
    .onComplete
    .add(function (result) {
        document
            .querySelector('#surveyResult')
            .textContent = "Result JSON:\n" + JSON.stringify(result.data, null, 3);
    });

survey.data = {
    satisfaction: 2
};

$("#surveyElement").Survey({model: survey});
    </script>
  </body>
</html>
