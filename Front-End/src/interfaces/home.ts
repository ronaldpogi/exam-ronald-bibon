export interface SlideshowItem {
  id: number
  img: string
  name: string
  link: string
}

export interface OfferItem {
  id: number
  img: string
}

export interface ServiceItem {
  id: number
  img: string
  title: string
  description: string
}

export interface HomeInterface {
  slideshow: SlideshowItem[]
  offers: OfferItem[]
  content: string
  services: ServiceItem[]
}
