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
    strokeWeight: 0.2,
    speed: 0.3,
    trailCount: 15,
    trailSpacing: 8,
  };

  const sketch = (s: p5) => {
    let w = 0, h = 0;

    // Définir les couleurs des lignes
    const lineColors = [
      [0, 255, 0],    // Vert
      [255, 0, 255],  // Rose


    ];

    // Chaque ligne est définie par :
    // - Deux points pour la ligne horizontale (gauche et droite)
    // - Deux points pour la ligne verticale (haut et bas)
    const lines = lineColors.map((_, index) => ({
      horizontal: {
        left: { x: 0, y: 0, vy: 0 },
        right: { x: 0, y: 0, vy: 0 },
      },
      vertical: {
        top: { x: 0, y: 0, vx: 0 },
        bottom: { x: 0, y: 0, vx: 0 },
      },
      color: lineColors[index],
    }));

    function initPoints() {
      lines.forEach((line) => {
        // Initialiser les points de la ligne horizontale
        line.horizontal.left.x = 0;
        line.horizontal.left.y = Math.random() * h;
        line.horizontal.left.vy = (Math.random() * 2 - 1) * params.speed;

        line.horizontal.right.x = w;
        line.horizontal.right.y = Math.random() * h;
        line.horizontal.right.vy = (Math.random() * 2 - 1) * params.speed;

        // Initialiser les points de la ligne verticale
        const commonX = Math.random() * w; // Valeur X commune
        const xOffset = (Math.random() * 20 - 10); // Décalage aléatoire entre -10 et +10 pixels

        line.vertical.top.x = commonX + xOffset;
        line.vertical.top.y = 0;
        line.vertical.top.vx = (Math.random() * 2 - 1) * params.speed;

        line.vertical.bottom.x = commonX - xOffset; // Décalage inverse pour un effet symétrique
        line.vertical.bottom.y = h;
        line.vertical.bottom.vx = (Math.random() * 2 - 1) * params.speed;

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

    function updateHorizontalPoint(p: any) {
      p.y += p.vy;
      // Rebond vertical uniquement
      if (p.y <= 0) {
        p.y = 0;
        p.vy *= -1;
      } else if (p.y >= h) {
        p.y = h;
        p.vy *= -1;
      }
    }

    function updateVerticalPoint(p: any) {
      p.x += p.vx;
      // Rebond horizontal uniquement
      if (p.x <= 0) {
        p.x = 0;
        p.vx *= -1;
      } else if (p.x >= w) {
        p.x = w;
        p.vx *= -1;
      }
    }

    s.draw = () => {
      s.clear();

      // Mettre à jour les positions des points
      lines.forEach((line) => {
        updateHorizontalPoint(line.horizontal.left);
        updateHorizontalPoint(line.horizontal.right);
        updateVerticalPoint(line.vertical.top);
        updateVerticalPoint(line.vertical.bottom);
      });

      // Dessiner les lignes horizontales et verticales
      lines.forEach((line) => {
        s.stroke(line.color[0], line.color[1], line.color[2]);
        s.strokeWeight(params.strokeWeight);

        // Ligne horizontale
        s.line(
          line.horizontal.left.x,
          line.horizontal.left.y,
          line.horizontal.right.x,
          line.horizontal.right.y
        );

        // Ligne verticale
        s.line(
          line.vertical.top.x,
          line.vertical.top.y,
          line.vertical.bottom.x,
          line.vertical.bottom.y
        );
      });
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
