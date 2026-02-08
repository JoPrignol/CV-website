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
    speed: .5,
    trailCount: 15,
    trailSpacing: 8,
  };

  const sketch = (s: p5) => {
    let w = 0, h = 0;
    const points = [
      { x: 0, y: 0, vx: 0, vy: 0 },
      { x: 0, y: 0, vx: 0, vy: 0 },
    ];

    // Points de contrôle pour les deux courbes
    const controlPoints = [
      // Première courbe : points de contrôle 1
      {
        control1: { x: 0, y: 0 },
        control2: { x: 0, y: 0 },
      },
      // Deuxième courbe : points de contrôle 2
      {
        control1: { x: 0, y: 0 },
        control2: { x: 0, y: 0 },
      },
    ];

    function initPoints() {
      points.forEach((p) => {
        p.x = Math.random() * w;
        p.vx = (Math.random() * 2 - 1) * params.speed;
        p.y = Math.random() * h;
        p.vy = (Math.random() * 2 - 1) * params.speed;
      });

      // Initialiser les points de contrôle pour les deux courbes
      controlPoints.forEach((controls) => {
        controls.control1.x = Math.random() * w;
        controls.control1.y = Math.random() * h;
        controls.control2.x = Math.random() * w;
        controls.control2.y = Math.random() * h;
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
      drawCurvesWithTrail(s, points, controlPoints);

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

        // Dessiner les deux courbes
        s.bezier(
          A.x, A.y,
          controlPoints[0].control1.x, controlPoints[0].control1.y,
          controlPoints[0].control2.x, controlPoints[0].control2.y,
          B.x, B.y
        );
        s.bezier(
          A.x, A.y,
          controlPoints[1].control1.x, controlPoints[1].control1.y,
          controlPoints[1].control2.x, controlPoints[1].control2.y,
          B.x, B.y
        );
      }
    };

    function drawCurvesWithTrail(s: p5, points: any[], controlPoints: any[]) {
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

        // Dessiner les deux courbes avec traînées
        s.bezier(
          A.x + offset, A.y + offset,
          controlPoints[0].control1.x + offset, controlPoints[0].control1.y + offset,
          controlPoints[0].control2.x + offset, controlPoints[0].control2.y + offset,
          B.x + offset, B.y + offset
        );
        s.bezier(
          A.x + offset, A.y + offset,
          controlPoints[1].control1.x + offset, controlPoints[1].control1.y + offset,
          controlPoints[1].control2.x + offset, controlPoints[1].control2.y + offset,
          B.x + offset, B.y + offset
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
