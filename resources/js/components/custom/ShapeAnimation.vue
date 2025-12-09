<!-- <template>
  <div ref="container" class="shape-animation-bg"></div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from "vue";
import p5 from "p5";

const container = ref<HTMLElement | null>(null);
let p5Instance: p5 | null = null;

onMounted(() => {
  const params = {
    strokeColor: [40, 40, 40, 80],
    strokeWeight: 2,
    speed: 2.5,
    trailCount: 5,
    trailSpacing: 10,
  };

  const sketch = (s: p5) => {
    let w = 0,
      h = 0;

    const points = [
      { x: 0, y: 0, vx: 0, vy: 0, halfBounce: true },
      { x: 0, y: 0, vx: 0, vy: 0, halfBounce: false },
      { x: 0, y: 0, vx: 0, vy: 0, halfBounce: true },
      { x: 0, y: 0, vx: 0, vy: 0, halfBounce: true },
      { x: 0, y: 0, vx: 0, vy: 0, halfBounce: true },
      { x: 0, y: 0, vx: 0, vy: 0, halfBounce: false },
      { x: 0, y: 0, vx: 0, vy: 0, halfBounce: true },
      { x: 0, y: 0, vx: 0, vy: 0, halfBounce: true },
      { x: 0, y: 0, vx: 0, vy: 0, halfBounce: false },
    ];

    function initPoints() {
      points.forEach((p) => {
        if (p.halfBounce) {
          const margin = 10; // petite marge pour éviter le dépassement immédiat
          p.x = Math.random() * (w / 2 - margin);
          p.vx = Math.random() * params.speed; // vx positif pour aller vers la droite
          p.vx *= -1; // inverser pour aller vers la gauche
        } else {
          p.x = Math.random() * w;
          p.vx = (Math.random() * 2 - 1) * params.speed;
        }

        p.y = Math.random() * h;
        p.vy = (Math.random() * 2 - 1) * params.speed;
      });
    }

    s.setup = () => {
      const rect = container.value?.getBoundingClientRect();
      w = rect?.width ?? window.innerWidth;
      h = rect?.height ?? window.innerHeight;

      const canvas = s.createCanvas(w, h);
      canvas.parent(container.value!);
      s.noFill();

      initPoints();
    };

    s.windowResized = () => {
      const rect = container.value?.getBoundingClientRect();
      w = rect?.width ?? window.innerWidth;
      h = rect?.height ?? window.innerHeight;
      s.resizeCanvas(w, h);
      initPoints();
    };

    function updatePoint(p: any) {
      const limitX = p.halfBounce ? w / 2 : w;
      const margin = 0.1; // petite marge pour éviter le dépassement

      p.x += p.vx;
      p.y += p.vy;

      // rebond horizontal
      if (p.x <= 0) {
        p.x = 0;
        p.vx *= -1;
      } else if (p.x >= limitX - margin) {
        p.x = limitX - margin;
        p.vx *= -1;
      }

      // rebond vertical
      if (p.y <= 0) {
        p.y = 0;
        p.vy *= -1;
      } else if (p.y >= h) {
        p.y = h;
        p.vy *= -1;
      }
    }

    s.draw = () => {
      s.clear();
      points.forEach(updatePoint);

      const [A, B, C, D, E, F, G, H, I] = points;

      for (let i = 0; i < 6; i++) {
        const alpha = 140 - i * 20;
        s.stroke(
          params.strokeColor[0],
          params.strokeColor[1],
          params.strokeColor[2],
          alpha
        );
        s.strokeWeight(params.strokeWeight - i * 0.5);

        s.line(A.x, A.y, B.x, B.y);
        s.line(B.x, B.y, C.x, C.y);
        s.line(C.x, C.y, D.x, D.y);
        s.line(D.x, D.y, E.x, E.y);
        s.line(E.x, E.y, F.x, F.y);
        s.line(F.x, F.y, G.x, G.y);
        s.line(G.x, G.y, H.x, H.y);
        s.line(H.x, H.y, I.x, I.y);
        s.line(I.x, I.y, A.x, A.y);
      }
    };
  };

  p5Instance = new p5(sketch);
});


onUnmounted(() => {
  p5Instance?.remove();
});
</script>

<style scoped>
.shape-animation-bg {
  position: fixed;
  inset: 0;
  z-index: -1;
  pointer-events: none;
}
</style>
 -->

<template>
  <div ref="container" class="shape-animation-bg"></div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from "vue";
import p5 from "p5";

const container = ref<HTMLElement | null>(null);
let p5Instance: p5 | null = null;

onMounted(() => {
  const params = {
    strokeColor: [0, 60, 0, 255],
    strokeWeight: 1,
    speed: 1,
    trailCount: 15,
    trailSpacing: 8,
  };

  const sketch = (s: p5) => {
    let w = 0,
      h = 0;

    const points = [
      { x: 0, y: 0, vx: 0, vy: 0 },
      { x: 0, y: 0, vx: 0, vy: 0 },
      { x: 0, y: 0, vx: 0, vy: 0 },
    ];

    function initPoints() {
      points.forEach((p) => {
        p.x = Math.random() * w;
        p.vx = (Math.random() * 2 - 1) * params.speed;

        p.y = Math.random() * h;
        p.vy = (Math.random() * 2 - 1) * params.speed;
      });
    }

    s.setup = () => {
      const rect = container.value?.getBoundingClientRect();
      w = rect?.width ?? window.innerWidth;
      h = rect?.height ?? window.innerHeight;

      const canvas = s.createCanvas(w, h);
      canvas.parent(container.value!);
      s.noFill();

      initPoints();
    };

    s.windowResized = () => {
      const rect = container.value?.getBoundingClientRect();
      w = rect?.width ?? window.innerWidth;
      h = rect?.height ?? window.innerHeight;
      s.resizeCanvas(w, h);
      initPoints();
    };

    function updatePoint(p: any) {
      const limitX = p.halfBounce ? w / 2 : w;
      const margin = 0.1; // petite marge pour éviter le dépassement

      p.x += p.vx;
      p.y += p.vy;

      // rebond horizontal
      if (p.x <= 0) {
        p.x = 0;
        p.vx *= -1;
      } else if (p.x >= limitX - margin) {
        p.x = limitX - margin;
        p.vx *= -1;
      }

      // rebond vertical
      if (p.y <= 0) {
        p.y = 0;
        p.vy *= -1;
      } else if (p.y >= h) {
        p.y = h;
        p.vy *= -1;
      }
    }

    s.draw = () => {
      s.clear();
      points.forEach(updatePoint);
      drawLineWithTrail(s, points.slice(0,3));

      const [A, B, C] = points;

      for (let i = 0; i < 6; i++) {
        const alpha = 140 - i * 20;
        s.stroke(
          params.strokeColor[0],
          params.strokeColor[1],
          params.strokeColor[2],
          alpha
        );
        s.strokeWeight(params.strokeWeight - i * 0.5);

        s.line(A.x, A.y, B.x, B.y);
        s.line(B.x, B.y, C.x, C.y);
        s.line(C.x, C.y, A.x, A.y);

        drawSegmentWithTrail(s, A, B);
        drawSegmentWithTrail(s, B, C);
        drawSegmentWithTrail(s, C, A);
      }
    };
    function drawSegmentWithTrail(s: p5, p1: any, p2: any) {
      for (let t = 0; t < params.trailCount; t++) {
        const offset = t * params.trailSpacing;
        s.stroke(
          params.strokeColor[0],
          params.strokeColor[1],
          params.strokeColor[2],
          140 - t * 20
        );
        s.strokeWeight(params.strokeWeight - t * 0.2);
        s.line(p1.x + offset, p1.y + offset, p2.x + offset, p2.y + offset);
      }
    }

  };

  // function drawLineWithTrail(s: p5, points: any[]) {
  //   const [A, B, C] = points;

  //   for (let t = 0; t < params.trailCount; t++) {
  //     const offset = t * params.trailSpacing;

  //     s.stroke(
  //       params.strokeColor[0],
  //       params.strokeColor[1],
  //       params.strokeColor[2],
  //       140 - t * 2 // fade progressive
  //     );
  //     s.strokeWeight(params.strokeWeight - t * 0.02);

  //     // décalage simple vers la droite et bas (tu peux changer)
  //     s.line(A.x + offset, A.y + offset, B.x + offset, B.y + offset);
  //     s.line(B.x + offset, B.y + offset, C.x + offset, C.y + offset);
  //     s.line(C.x + offset, C.y + offset, A.x + offset, A.y + offset);
  //   }
  // }

  function drawLineWithTrail(s: p5, points: any[]) {
    const [A, B, C] = points;

    const startColor = [255, 0, 0]; // rouge
    const endColor = [0, 0, 255];   // bleu

    for (let t = 0; t < params.trailCount; t++) {
      const offset = t * params.trailSpacing;
      const alpha = 140 - t * 2;

      // Interpolation linéaire des couleurs
      const r = s.lerp(startColor[0], endColor[0], t / (params.trailCount - 1));
      const g = s.lerp(startColor[1], endColor[1], t / (params.trailCount - 1));
      const b = s.lerp(startColor[2], endColor[2], t / (params.trailCount - 1));

      s.stroke(r, g, b, alpha);
      s.strokeWeight(params.strokeWeight - t * 0.02);

      s.line(A.x + offset, A.y + offset, B.x + offset, B.y + offset);
      s.line(B.x + offset, B.y + offset, C.x + offset, C.y + offset);
      s.line(C.x + offset, C.y + offset, A.x + offset, A.y + offset);
    }
  }


  p5Instance = new p5(sketch);
});


onUnmounted(() => {
  p5Instance?.remove();
});
</script>

<style scoped>
.shape-animation-bg {
  position: fixed;
  inset: 0;
  z-index: -1;
  pointer-events: none;
}
</style>
