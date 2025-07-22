export interface Author {
  id: number;
  name: string;
  email: string;
  total_books: number;
}

export interface Book {
  id: number;
  title: string;
  description: string;
  author: Author;
}

export interface User {
  id: number;
  name: string;
  email: string;
}
