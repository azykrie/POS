<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in | KasirKu</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/dist/css/adminlte.min.css?v=3.2.0">
    <script nonce="636e2552-7177-4a41-8721-2a133785d24e">
        (function(w, d) {
            ! function(bS, bT, bU, bV) {
                bS[bU] = bS[bU] || {};
                bS[bU].executed = [];
                bS.zaraz = {
                    deferred: [],
                    listeners: []
                };
                bS.zaraz.q = [];
                bS.zaraz._f = function(bW) {
                    return async function() {
                        var bX = Array.prototype.slice.call(arguments);
                        bS.zaraz.q.push({
                            m: bW,
                            a: bX
                        })
                    }
                };
                for (const bY of ["track", "set", "debug"]) bS.zaraz[bY] = bS.zaraz._f(bY);
                bS.zaraz.init = () => {
                    var bZ = bT.getElementsByTagName(bV)[0],
                        b$ = bT.createElement(bV),
                        ca = bT.getElementsByTagName("title")[0];
                    ca && (bS[bU].t = bT.getElementsByTagName("title")[0].text);
                    bS[bU].x = Math.random();
                    bS[bU].w = bS.screen.width;
                    bS[bU].h = bS.screen.height;
                    bS[bU].j = bS.innerHeight;
                    bS[bU].e = bS.innerWidth;
                    bS[bU].l = bS.location.href;
                    bS[bU].r = bT.referrer;
                    bS[bU].k = bS.screen.colorDepth;
                    bS[bU].n = bT.characterSet;
                    bS[bU].o = (new Date).getTimezoneOffset();
                    if (bS.dataLayer)
                        for (const ce of Object.entries(Object.entries(dataLayer).reduce(((cf, cg) => ({
                                ...cf[1],
                                ...cg[1]
                            })), {}))) zaraz.set(ce[0], ce[1], {
                            scope: "page"
                        });
                    bS[bU].q = [];
                    for (; bS.zaraz.q.length;) {
                        const ch = bS.zaraz.q.shift();
                        bS[bU].q.push(ch)
                    }
                    b$.defer = !0;
                    for (const ci of [localStorage, sessionStorage]) Object.keys(ci || {}).filter((ck => ck
                        .startsWith("_zaraz_"))).forEach((cj => {
                        try {
                            bS[bU]["z_" + cj.slice(7)] = JSON.parse(ci.getItem(cj))
                        } catch {
                            bS[bU]["z_" + cj.slice(7)] = ci.getItem(cj)
                        }
                    }));
                    b$.referrerPolicy = "origin";
                    b$.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(bS[bU])));
                    bZ.parentNode.insertBefore(b$, bZ)
                };
                ["complete", "interactive"].includes(bT.readyState) ? zaraz.init() : bS.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ asset('AdminLTE') }}/index2.html" class="h1"><b>Kasir</b>Ku</a>
            </div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>


    <script src="{{ asset('AdminLTE') }}/plugins/jquery/jquery.min.js"></script>

    <script src="{{ asset('AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('AdminLTE') }}/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>
