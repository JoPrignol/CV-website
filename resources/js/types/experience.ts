import { Company } from './company';

export interface Experience {
    id: number;
    position: string;
    description: string;
    location: string;
    start_date: string;
    end_date: string | null;
    company: Company;
  }
