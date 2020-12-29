window.addEventListener('load', function () {
    (function () {
        MorphSVGPlugin.convertToPath("circle, rect, ellipse, line, polygon, polyline");
        const select = function (x) {
            return document.querySelector(x);
        };
        const selectAll = function (x) {
            return document.querySelectorAll(x);
        };
    
        const animationWrapper = select('.animationWrapper');
        const outline = select('#outline');
        const lionMouthPaths = selectAll('#mouth > path');
    
        const lionMouth = selectAll('#mouth');
        const lion = select('#lion-group');
        const lionHead = selectAll('#head > path');
        const lionTorso = select('#torso');
    
        const animationWrapperSmall = select('.animation__small');
        const outlineSmall = select('#outline-small');
        const lionMouthPathsSmall = selectAll('#mouth-small > path');
    
        const lionMouthSmall = selectAll('#mouth-small');
        const lionSmall = select('#lion-group-small');
        const lionHeadSmall = selectAll('#head-small > path');
        const lionTorsoSmall = select('#torso-small');
    
    
        TweenLite.set([animationWrapper,animationWrapperSmall], {autoAlpha: 1});
    
        function tl01() {
            const tl = new TimelineMax();
            tl
                .add('play')
                .from(lionTorso, 1, {autoAlpha: 0}, 'play+=0.8')
                .staggerFrom(lionHead, 1, {autoAlpha: 0, scale: 0, transformOrigin: 'center top', cycle: {rotation: [-5, -10, 0, 20, 10], y: [-5, -10, 0, 5, 10], x: [-5, -10, 0, 5, 10]}}, -0.003, 'play-=0.3')
                .staggerFrom(lionMouthPaths, 1, {autoAlpha: 0, scale: 0, transformOrigin: 'center top', cycle: {rotation: [-5, -10, 0, 20, 10], y: [-5, -10, 0, 5, 10], x: [-5, -10, 0, 5, 10]}}, 0.004, 'play+=1')
                .from(outline, 2, {autoAlpha: 0}, '-=1')
                .add('playMouth', '-=2.7')
                .to(lion, 1, {rotation: '+=5', repeat: 1, yoyo: true}, 'playMouth')
                .to(lionMouth, 1.4, {rotation: '+=20', transformOrigin: '20% 10%', ease: Back.easeInOut, repeat: 1, yoyo: true}, 'playMouth')
                .to(lionMouth, 1.4, {rotation: '+=20', transformOrigin: '20% 10%', ease: Back.easeInOut, repeat: 3, yoyo: true})
    
            ;
            return tl;
        }
    
        function tl02() {
            const tl = new TimelineMax();
            tl
                .add('play')
                .from(lionTorsoSmall, 1, {autoAlpha: 0}, 'play+=0.8')
                .staggerFrom(lionHeadSmall, 1, {autoAlpha: 0, scale: 0, transformOrigin: 'center top', cycle: {rotation: [-5, -10, 0, 20, 10], y: [-5, -10, 0, 5, 10], x: [-5, -10, 0, 5, 10]}}, -0.003, 'play-=0.3')
                .staggerFrom(lionMouthPathsSmall, 1, {autoAlpha: 0, scale: 0, transformOrigin: 'center top', cycle: {rotation: [-5, -10, 0, 20, 10], y: [-5, -10, 0, 5, 10], x: [-5, -10, 0, 5, 10]}}, 0.004, 'play+=1')
                .from(outlineSmall, 2, {autoAlpha: 0}, '-=1')
                .add('playMouth', '-=2.7')
                .to(lionSmall, 1, {rotation: '+=5', repeat: 1, yoyo: true}, 'playMouth')
                .to(lionMouthSmall, 1.4, {rotation: '+=20', transformOrigin: '20% 10%', ease: Back.easeInOut, repeat: 1, yoyo: true}, 'playMouth')
                .to(lionMouthSmall, 1.4, {rotation: '+=20', transformOrigin: '20% 10%', ease: Back.easeInOut, repeat: 3, yoyo: true})
            ;
            return tl;
        }
    
        const master = new TimelineMax({paused: true});
        master
    
            .add(tl01(),0)
            .add(tl02(),0)
        ;
        master.timeScale(1.5);
    
        animationWrapper.addEventListener('click', function () {
            master.progress(0).play(0);
        });
    
        TweenLite.to('body',1,{autoAlpha:1},0);
        master.play();
    }());
});