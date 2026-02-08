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
    trailSpacing: 8,  // Réduit pour des traînées plus serrées
  };

  const sketch = (s: p5) => {
    let w = 0, h = 0;
    // 4 points pour former un carré
    const points = [
      { x: 0, y: 0, vx: 0, vy: 0 },  // Point A (haut-gauche)
      { x: 0, y: 0, vx: 0, vy: 0 },  // Point B (haut-droite)
      { x: 0, y: 0, vx: 0, vy: 0 },  // Point C (bas-droite)
      { x: 0, y: 0, vx: 0, vy: 0 }   // Point D (bas-gauche)
    ];

    function initPoints() {
      // Positionner les points pour former un carré
      const margin = 200; // Marge par rapport aux bords

      // Point A : haut-gauche
      points[0].x = margin;
      points[0].y = margin;
      points[0].vx = (Math.random() * 2 - 1) * params.speed;
      points[0].vy = (Math.random() * 2 - 1) * params.speed;

      // Point B : haut-droite
      points[1].x = w - margin;
      points[1].y = margin;
      points[1].vx = (Math.random() * 2 - 1) * params.speed;
      points[1].vy = (Math.random() * 2 - 1) * params.speed;

      // Point C : bas-droite
      points[2].x = w - margin;
      points[2].y = h - margin;
      points[2].vx = (Math.random() * 2 - 1) * params.speed;
      points[2].vy = (Math.random() * 2 - 1) * params.speed;

      // Point D : bas-gauche
      points[3].x = margin;
      points[3].y = h - margin;
      points[3].vx = (Math.random() * 2 - 1) * params.speed;
      points[3].vy = (Math.random() * 2 - 1) * params.speed;
    }

    s.setup = () => {
      const rect = container.value?.getBoundingClientRect();
      w = rect?.width ?? window.innerWidth;
      h = rect?.height ?? window.innerHeight;
      const canvas = s.createCanvas(w, h);
      canvas.parent(container.value!);
      s.noFill();
      s.smooth();  // Pour des lignes plus lisses
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
      p.x += p.vx;
      p.y += p.vy;

      // Rebond horizontal
      const margin = 5;
      if (p.x <= margin) {
        p.x = margin;
        p.vx *= -1;
      } else if (p.x >= w - margin) {
        p.x = w - margin;
        p.vx *= -1;
      }

      // Rebond vertical
      if (p.y <= margin) {
        p.y = margin;
        p.vy *= -1;
      } else if (p.y >= h - margin) {
        p.y = h - margin;
        p.vy *= -1;
      }
    }

    s.draw = () => {
      s.clear();
      s.background(0, 0, 0, 5);  // Fond légèrement transparent pour l'effet de traînées

      points.forEach(updatePoint);

      // Dessiner le carré principal
      const [A, B, C, D] = points;
      s.stroke(0, 255, 0);  // Vert
      s.strokeWeight(params.strokeWeight);
      s.line(A.x, A.y, B.x, B.y);  // Haut
      s.line(B.x, B.y, C.x, C.y);  // Droite
      s.line(C.x, C.y, D.x, D.y);  // Bas
      s.line(D.x, D.y, A.x, A.y);  // Gauche

      // Dessiner les traînées du carré (un carré complet pour chaque traînée)
      drawSquareTrails(s, points);
    };

    function drawSquareTrails(s: p5, points: any[]) {
      const [A, B, C, D] = points;
      const startColor = [255, 0, 0]; // rouge
      const endColor = [0, 0, 255];   // bleu

      for (let t = 0; t < params.trailCount; t++) {
        const offset = t * params.trailSpacing;
        const alpha = s.map(t, 0, params.trailCount, 200, 0);
        const weight = s.map(t, 0, params.trailCount, params.strokeWeight, 0.1);

        // Interpolation linéaire des couleurs
        const r = s.lerp(startColor[0], endColor[0], t / (params.trailCount - 1));
        const g = s.lerp(startColor[1], endColor[1], t / (params.trailCount - 1));
        const b = s.lerp(startColor[2], endColor[2], t / (params.trailCount - 1));

        s.stroke(r, g, b, alpha);
        s.strokeWeight(weight);

        // Dessiner un carré complet pour chaque traînée
        s.line(A.x, A.y + offset, B.x, B.y + offset);  // Haut
        s.line(B.x, B.y + offset, C.x, C.y + offset);  // Droite
        s.line(C.x, C.y + offset, D.x, D.y + offset);  // Bas
        s.line(D.x, D.y + offset, A.x, A.y + offset);  // Gauche
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
