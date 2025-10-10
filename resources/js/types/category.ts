import { Skill } from './skill';

export interface Category {
  id: number;
  name: string;
  skills: Skill[];
}
