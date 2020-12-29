(function () {
    // GSDevTools.create();
    const select = function (x) {
        return document.querySelector(x);
    };
    const selectAll = function (x) {
        return document.querySelectorAll(x);
    };
    MorphSVGPlugin.convertToPath("circle, rect, ellipse, line, polygon, polyline");
    const animationWrapper = select('.animation__wrapper');


    const xBlue = select('#x_blue');
    const x_both = select('#x_both');
    const bla = select('#bla');
    const tla = select('#tla');
    const tra = select('#tra');
    const bra = select('#bra');
    const tlM = select('#tlM');
    const trM = select('#trM');
    const brM = select('#brM');
    const blM = select('#blM');

    const xPurple = select('#x_purple');
    const bla2 = select('#bla-2');
    const tla2 = select('#tla-2');
    const tra2 = select('#tra-2');
    const bra2 = select('#bra-2');
    const tlM2 = select('#tlM-2');
    const trM2 = select('#trM-2');
    const brM2 = select('#brM-2');
    const blM2 = select('#blM-2');


    const returnedTl01 = tl01();
    TweenLite.set(animationWrapper, {autoAlpha: 1});


    function tl01() {
        const tl = new TimelineMax({repeat: -1, yoyo: true, repeatDelay: 1});
        const xBlue = select('#x_blue');
        const x_both = select('#x_both');
        const bla = select('#bla');
        const tla = select('#tla');
        const tra = select('#tra');
        const bra = select('#bra');
        const tlM = select('#tlM');
        const trM = select('#trM');
        const brM = select('#brM');
        const blM = select('#blM');

        const xPurple = select('#x_purple');
        const bla2 = select('#bla-2');
        const tla2 = select('#tla-2');
        const tra2 = select('#tra-2');
        const bra2 = select('#bra-2');
        const tlM2 = select('#tlM-2');
        const trM2 = select('#trM-2');
        const brM2 = select('#brM-2');
        const blM2 = select('#blM-2');
        tl

            .to(animationWrapper, 0.1, {autoAlpha: 1})
            .add('scale')

            .from(x_both, 2, {scale: 1.5, transformOrigin: 'center center', ease: Power0.easeNone}, 0)
            .from(xPurple, 2, {scale: 35, transformOrigin: 'center center', ease: Power0.easeNone}, 0)
            .from(xBlue, 1, {scale: 35, transformOrigin: 'center center', ease: Power0.easeNone}, 0)
            .add('play', '-=0.2')

            .to(tla, 1, {morphSVG: tlM, ease: Power0.easeNone}, 'play')
            .to(tlM, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play+=1')
            .to(tla, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play+=1')

            .to(tra, 1, {morphSVG: trM, ease: Power0.easeNone}, 'play')
            .to(trM, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play+=1')
            .to(tra, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play+=1')

            .to(bla, 1, {morphSVG: blM, ease: Power0.easeNone}, 'play')
            .to(blM, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play+=1')
            .to(bla, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play+=1')

            .to(bra, 1, {morphSVG: brM, ease: Power0.easeNone}, 'play')
            .to(brM, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play+=1')
            .to(bra, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play+=1')


            .add('play2', '-=2')

            .to(tla2, 1, {morphSVG: tlM2, ease: Power0.easeNone}, 'play2')
            .to(tlM2, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play2+=1')
            .to(tla2, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play2+=1')

            .to(tra2, 1, {morphSVG: trM2, ease: Power0.easeNone}, 'play2')
            .to(trM2, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play2+=1')
            .to(tra2, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play2+=1')

            .to(bla2, 1, {morphSVG: blM2, ease: Power0.easeNone}, 'play2')
            .to(blM2, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play2+=1')
            .to(bla2, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play2+=1')

            .to(bra2, 1, {morphSVG: brM2, ease: Power0.easeNone}, 'play2')
            .to(brM2, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play2+=1')
            .to(bra2, 0.01, {transformOrigin: 'center center', autoAlpha: 0}, 'play2+=1')


        ;
        return tl.timeScale(1.01);
    }


}());