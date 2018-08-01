@extends('layouts.jheader')

@section('title', 'Welcome to Joonley!')

@section('content')
<div class="logdiv alignright">
    <a class="loglink1" href="{{ route('login') }}">Log In</a>
</div>
<div class="introsection">
        <div class = "introTitle2">
            Dear Wholesale,
        </div>
        <div class = "introTitle2">
            It's time for a change.
        </div>
        <div class = "introTitle2">
            Respecfully,
        </div>
        <div class = "introTitle2">
            Joonley
        </div>
        <div class = "introbody2">
            Finally: A commmission-free wholesale experience.
        </div>
        <div align="left">
            <table border="0">
                <tr>
                    <td><a class="btn" href="/registerSeller">Apply To Sell</a></td>
                    <td><a class="btn" href="/registerBuyer">Sign Up To Buy</a></td>
                </tr>
            </table>
        </div>
</div>

<div class="introsection">
<div class="introTitle">
    Hi I'm Joonley<br>
    Allow Me to Introduce Myself
</div>
<div class="introBody">
    Joonley is a digital wholesale platform. It allows wholesale buyers to purchase directly from sellers, without a middleman.
<br>
    It allows sellers create and maintain new wholesale relationships without paying pricey comissions or show fees.
<br>
    We all know this is the future of wholesale. Joonley wants to take you there.

</div>

<div align="center">
    <table border="0">
        <tr>
            <td><a class="btn" href="registerSeller">Apply To Sell</a></td>
            <td><a class="btn" href="">Learn More</a></td>
            <td><a class="btn" href="registerBuyer">Sign Up To Buy</a></td>
        </tr>
    </table>
</div>
</div>
<div class="introsection">
    <div class = "introTitle2">
        Sellers,
    </div>
    <div class = "introTitle2">
        This time, it's different.
    </div>
    <br/><br/>
    <div class = "introbody3">
        Margins are hard enough to manage at the wholesale level, especially with increased global competition. Why pay 10%, 15%, 20% or more(!) comission on wholesale orders? Why pay showroom show fees?
<br/><br/>
        That's old school, and we all know it's time for a change.

    </div>
    <div align="left">
        <table border="0">
            <tr>
                <td><a class="btn" href="registerSeller">Apply To Sell</a></td>
                <td><a class="btn" href="">Learn More</a></td>
            </tr>
        </table>
    </div>

</div>

<div class="introsection">
    <div class="intro4">
            <div class = "introTitle2">
                Buyers,
            </div>
            <div class = "introTitle2">
                It's a good kind of different.
            </div>
            <br/><br/>
            <div class = "introbody4">
                In this case, where you shop does make a difference. It's difficult to buy without physically seeing a product. That's why we encourage our sellers to take a more modern approach to wholesaling: think lower opening minumums, single samples or trial packs, and flexible return policies.

                <br/><br/>
                Free from traditional comissions and show fees, our sellers can offer incentives directly to you, savings you can't find anywhere else.
            </div>
            <div align="left">
                <table border="0">
                    <tr>
                        <td><a class="btn" href="registerBuyer">Sign Up To Buy</a></td>
                        <td><a class="btn" href="">Learn More</a></td>
                    </tr>
                </table>
            </div>

    </div>
    <br/><br/><br/>
    <div style="font-size:3em; color:#3498db" align="center">
        <i class="fab fa-twitter"></i>
        <i class="fab fa-facebook-square"></i>
        <i class="fab fa-instagram"></i>
        <i class="fas fa-envelope"></i>
    </div>
</div>
@endsection
