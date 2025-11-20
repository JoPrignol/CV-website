import { Tag } from "./tag";

export interface Project {
    id: number;
    title: string;
    description: string | null;
    url: string | null;
    main_image: string;
    main_image_url?: string;
    secondary_images: string[];
    secondary_images_urls?: string[];
    tags: Tag[];
  }
