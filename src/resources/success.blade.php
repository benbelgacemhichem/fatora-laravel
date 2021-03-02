<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
        html,
        body {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body {
            overflow: hidden;
        }

        .background {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .modalbox.success,
        .modalbox.error {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            background: #fff;
            padding: 25px 25px 15px;
            text-align: center;
        }

        .modalbox.success.animate .icon,
        .modalbox.error.animate .icon {
            -webkit-animation: fall-in 0.75s;
            -moz-animation: fall-in 0.75s;
            -o-animation: fall-in 0.75s;
            animation: fall-in 0.75s;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        }

        .modalbox.success h1,
        .modalbox.error h1 {
            font-family: 'Montserrat', sans-serif;
        }

        .modalbox.success p,
        .modalbox.error p {
            font-family: 'Open Sans', sans-serif;
        }

        .modalbox.success button,
        .modalbox.error button,
        .modalbox.success button:active,
        .modalbox.error button:active,
        .modalbox.success button:focus,
        .modalbox.error button:focus {
            -webkit-transition: all 0.1s ease-in-out;
            transition: all 0.1s ease-in-out;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
            margin-top: 15px;
            width: 80%;
            background: transparent;
            color: #4caf50;
            border-color: #4caf50;
            outline: none;
        }

        .modalbox.success button:hover,
        .modalbox.error button:hover,
        .modalbox.success button:active:hover,
        .modalbox.error button:active:hover,
        .modalbox.success button:focus:hover,
        .modalbox.error button:focus:hover {
            color: #fff;
            background: #4caf50;
            border-color: transparent;
        }

        .modalbox.success .icon,
        .modalbox.error .icon {
            position: relative;
            margin: 0 auto;
            margin-top: -75px;
            background: #4caf50;
            height: 100px;
            width: 100px;
            border-radius: 50%;
        }

        .modalbox.success .icon span,
        .modalbox.error .icon span {
            postion: absolute;
            font-size: 4em;
            color: #fff;
            text-align: center;
            padding-top: 20px;
        }

        .center {
            float: none;
            margin-left: auto;
            margin-right: auto;
        }

        .center .change {
            clearn: both;
            display: block;
            font-size: 10px;
            color: #ccc;
            margin-top: 10px;
        }

    </style>
</head>

<body>
    <div class="background"></div>
    <div class="container">
        <div class="row">
            <div class="modalbox success col-sm-8 col-md-6 col-lg-5 center animate">
                <div class="icon">
                    <span class="glyphicon glyphicon-ok"></span>
                </div>
                <h1>Payment Success!</h1>
                <p>Thank you for your payment. An automated receipt will be sent to your registred email.</p>
                <a href="#" type="button" class="btn">Return </button>
            </div>
        </div>
    </div>
</body>

</html>
