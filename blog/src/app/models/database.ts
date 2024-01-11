type Database =
{
  about:
  {
    id:string,
    photoCover:string,
    photoProfile:string,
    name: string,
    position: string,
    title: string,
    description: string,
    socialMedia:SocialMedia
  },
  settings:
  {
    id:string,
    appName:string
  }
}

type SocialMedia =
  [
    {
      id:string,
      name:string
    }
  ]

export {Database, SocialMedia}
