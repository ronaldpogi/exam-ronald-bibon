export interface ContactItem {
  label: string
  value: string
  img: string
}

export interface FooterItem {
  name: string
  img: string
  link: string
}

export interface GlobalInterface {
  logo: string
  link: {
    login: string
    register: string
  }
  download_app: {
    img: string
    link: string
  }
  contact: ContactItem[]
  footer: FooterItem[]
}
