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
    speed: .8,
    trailCount: 15,
    trailSpacing: 8,
  };

  const sketch = (s: p5) => {
    let w = 0, h = 0;
    const points = [
      { x: 0, y: 0, vx: 0, vy: 0, control1: { x: 0, y: 0 }, control2: { x: 0, y: 0 } },
      { x: 0, y: 0, vx: 0, vy: 0, control1: { x: 0, y: 0 }, control2: { x: 0, y: 0 } },
    ];

    function initPoints() {
      // Point A : fixé à gauche (x=0), position Y aléatoire
      points[0].x = 0;
      points[0].y = Math.random() * h;
      points[0].vx = 0;  // Pas de mouvement horizontal
      points[0].vy = (Math.random() * 2 - 1) * params.speed;

      // Point B : fixé à droite (x=w), position Y aléatoire
      points[1].x = w;
      points[1].y = Math.random() * h;
      points[1].vx = 0;  // Pas de mouvement horizontal
      points[1].vy = (Math.random() * 2 - 1) * params.speed;

      points.forEach((p) => {
        // Initialiser les points de contrôle pour les courbes
        p.control1.x = Math.random() * w;
        p.control1.y = Math.random() * h;
        p.control2.x = Math.random() * w;
        p.control2.y = Math.random() * h;
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
      // initPoints();
    };

    function updatePoint(p: any) {
      const limitX = w;
      const margin = 0.1;
      p.x += p.vx;
      p.y += p.vy;

      // Rebond horizontal
      if (p.x <= 0) {
        p.x = 0;
        p.vx *= -1;
      } else if (p.x >= limitX - margin) {
        p.x = limitX - margin;
        p.vx *= -1;
      }

      // Rebond vertical
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
      drawCurveWithTrail(s, points.slice(0, 3));
      const [A, B] = points;

      for (let i = 0; i < 6; i++) {
        const alpha = 140 - i * 20;
        s.stroke(
          params.strokeColor[0],
          params.strokeColor[1],
          params.strokeColor[2],
          alpha
        );
        s.strokeWeight(params.strokeWeight - i * 0.5);

        // Dessiner des courbes
        s.bezier(
          A.x, A.y,
          A.control1.x, A.control1.y,
          B.control2.x, B.control2.y,
          B.x, B.y
        );

        drawSegmentWithCurve(s, A, B);
      }
    };

    function drawSegmentWithCurve(s: p5, p1: any, p2: any) {
      for (let t = 0; t < params.trailCount; t++) {
        const offset = t * params.trailSpacing;
        s.stroke(
          params.strokeColor[0],
          params.strokeColor[1],
          params.strokeColor[2],
          140 - t * 20
        );
        s.strokeWeight(params.strokeWeight - t * 0.2);

        // Dessiner une courbe pour chaque segment
        s.bezier(
          p1.x, p1.y + offset,
          p1.control1.x, p1.control1.y + offset,
          p2.control2.x, p2.control2.y + offset,
          p2.x, p2.y + offset
        );
      }
    }

    function drawCurveWithTrail(s: p5, points: any[]) {
      const [A, B] = points;
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

        // Dessiner des courbes avec traînées
        s.bezier(
          A.x, A.y + offset,
          A.control1.x, A.control1.y + offset,
          B.control2.x, B.control2.y + offset,
          B.x, B.y + offset
        );
      }
    }
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
