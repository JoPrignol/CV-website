import { Tag } from "./tag";

export interface Project {
    id: number;
    title: string;
    description: string | null;
    link: string | null;
    main_image: string;
    secondary_images: string[];
    tags: Tag[];
  }
