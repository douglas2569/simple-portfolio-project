import { Component, OnInit } from '@angular/core';
import { AboutService } from 'src/app/services/about.service';
import SocialMedia from '../../models/SocialMedia';

@Component({
  selector: 'app-about',
  templateUrl: './about.component.html',
  styleUrls: ['./about.component.css']
})

export class AboutComponent implements OnInit {
  photoProfile!:string
  name!:string
  position!:string
  title!:string
  description!:string
  socialMedia!:Array<SocialMedia>

  constructor(private aboutService:AboutService) {
  }

  ngOnInit(): void {
    this.mount()
  }

  mount():void{

    this.aboutService.getAbout().subscribe((response)=>{
      this.photoProfile = response.data.profile_photo
      this.name = response.data.name
      this.position = response.data.position
      this.title = response.data.title
      this.description = response.data.description
      this.socialMedia = response.data.social_media
    })
  }
}
