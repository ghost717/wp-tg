(function () {
    GSDevTools.create();
    const select = function (x) {
        return document.querySelector(x);
    };
    const selectAll = function (x) {
        return document.querySelectorAll(x);
    };
    MorphSVGPlugin.convertToPath("circle, rect, ellipse, line, polygon, polyline");
    const animationWrapper = select('.animation__wrapper');


    const xBlue = select('#x_blue');


    const returnedTl01 = tl01();
    TweenLite.set(animationWrapper, {autoAlpha: 1});


    function tl01() {
        const tl = new TimelineMax({repeat: -1, yoyo: true, repeatDelay: 1});
        tl

            .to(animationWrapper, 0.1, {autoAlpha: 1})
            //
            // .add('play_01')
            // .to('#left_green_triangle_mask > path', 1, {transformOrigin: '0 50%', rotation: -180, scale: 3},'play_01')
            // .to('#right_green_triangle_mask > path', 1, {transformOrigin: '100% 50%', rotation: -180, scale: 3},'play_01')
            // .add('play_02')
            // .to('#left_green_triangle_mask > path', 1, {transformOrigin: '0 50%', rotation: '-=180', scale: 3},'play_02')
            // .to('#right_green_triangle_mask > path', 1, {transformOrigin: '100% 50%', rotation: '-=180', scale: 3},'play_02')


            .add('play_01')
            .to('#left_green-blue_mask > path', 1, {transformOrigin: '0 50%', rotation: -180, scale: 3},'play_01')
            .to('#right_green-blue_mask > path', 1, {transformOrigin: '100% 50%', rotation: -180, scale: 3},'play_01')
            .add('play_02')
            .to('#left_green-blue_mask > path', 1, {transformOrigin: '0 50%', rotation: '-=180', scale: 3},'play_02')
            .to('#right_green-blue_mask > path', 1, {transformOrigin: '100% 50%', rotation: '-=180', scale: 3},'play_02')

            // .to('#right_green_triangle_mask', 1, { x: 380, scale: 3})
            // .to('#right_green_triangle_mask > path', 1, {transformOrigin: '-50% 50%', rotation: '-=180', scale: 3})


        ;
        return tl.timeScale(1.01);
    }


}());