import { Component, OnInit } from '@angular/core';
import CoverPhoto from 'src/app/models/CoverPhoto';
import { CoverPhotoService } from 'src/app/services/coverphoto.service';

@Component({
  selector: 'app-coverphoto',
  templateUrl: './coverphoto.component.html',
  styleUrls: ['./coverphoto.component.css']
})
export class CoverPhotoComponent implements OnInit {
  coverPhoto!:Array<CoverPhoto>

  constructor(private coverPhotoService:CoverPhotoService) { }

  ngOnInit(): void {
    this.mount()
  }

  mount():void{

    this.coverPhotoService.getCoverPhoto().subscribe((response)=>{
      this.coverPhoto = response.data
    })
  }

}
